#!/usr/bin/env bash

set -e

export LDAP_PORT_NUMBER=${LDAP_PORT_NUMBER:-1389}

function is_bitnami {
  [ -d /opt/bitnami/scripts/ ]
}

# if script is running in the bitnami image as a part of /docker-entrypoint-initdb.d
# we have to launch a ldap server manually
# the server is being stopped here: https://github.com/bitnami/containers/blob/fccaa4c4a4d7755c19c2e02ddef7ac3736dfcbb9/bitnami/openldap/2.6/debian-11/rootfs/opt/bitnami/scripts/libopenldap.sh#L527
# custom initdb.d scripts are being executed after the server is stopped
# https://github.com/bitnami/containers/blob/fccaa4c4a4d7755c19c2e02ddef7ac3736dfcbb9/bitnami/openldap/2.5/debian-11/rootfs/opt/bitnami/scripts/openldap/setup.sh#L25

if is_bitnami; then
  . /opt/bitnami/scripts/libos.sh
  . /opt/bitnami/scripts/libopenldap.sh
  ldap_start_bg
  while is_ldap_not_running; do sleep 1; done
fi

CURRENT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" >/dev/null 2>&1 && pwd )"
LDIFS="${CURRENT_DIR}/ldifs"

echo "Applying ACL mod for zf1..."

ldapmodify -v -x \
  -D "cn=${LDAP_CONFIG_ADMIN_USERNAME},cn=config" \
  -w "${LDAP_CONFIG_ADMIN_PASSWORD}" \
  -H "ldap://127.0.0.1:${LDAP_PORT_NUMBER}" \
  -f "${LDIFS}/acl-mod.ldif"


echo "Loading LDIFs fixtures..."

ldapadd -v -x \
  -D "cn=${LDAP_ADMIN_USERNAME},${LDAP_ROOT}" \
  -w "${LDAP_ADMIN_PASSWORD}" \
  -H "ldap://127.0.0.1:${LDAP_PORT_NUMBER}" \
  -f ${LDIFS}/example.com.ldif

files=(
  "manager.example.com.ldif"
  "test.example.com.ldif"
  "user1.example.com.ldif"
)

for file in "${files[@]}"; do \
  ldapadd -v -x \
    -D "cn=${LDAP_ADMIN_USERNAME},${LDAP_ROOT}" \
    -w "${LDAP_ADMIN_PASSWORD}" \
    -H "ldap://127.0.0.1:${LDAP_PORT_NUMBER}" \
    -f "${LDIFS}/${file}"
done

if is_bitnami; then
  ldap_stop
fi
