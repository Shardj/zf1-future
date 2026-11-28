<?php

use Yoast\PHPUnitPolyfills\TestCases\TestCase;

class Zend_Pdf_Filter_Compression_FlateTest extends TestCase
{
    protected function set_up()
    {
        if (!extension_loaded('zlib')) {
            self::markTestSkipped('This test requires zlib');
        }
    }

    public function testEncodeWithPredictorRejectsIncompleteRows()
    {
        $this->expectException(Zend_Pdf_Exception::class);
        $this->expectExceptionMessage('Wrong data length.');

        Zend_Pdf_Filter_Compression_Flate::encode('12345', ['Predictor' => 11, 'Columns' => 4]);
    }

    /**
     * The PNG predictors store byte differences modulo 256; rows are chosen so
     * that the differences are negative as well.
     *
     * @dataProvider pngPredictorProvider
     */
    public function testEncodeAndDecodeWithPngPredictor($predictor)
    {
        $data = "\xFF\x10\x80\x00" . "\x00\xFF\x01\x7F" . "\x05\x04\x03\x02" . "\xFE\xFF\x00\x01";
        $params = ['Predictor' => $predictor, 'Columns' => 4];

        $encoded = Zend_Pdf_Filter_Compression_Flate::encode($data, $params);

        self::assertSame($data, Zend_Pdf_Filter_Compression_Flate::decode($encoded, $params));
    }

    public static function pngPredictorProvider()
    {
        return [
            'none'    => [10],
            'sub'     => [11],
            'up'      => [12],
            'average' => [13],
            'paeth'   => [14],
            'optimal' => [15],
        ];
    }

    public function testDecodeRejectsDataThatIsNotCompressed()
    {
        $this->expectException(Zend_Pdf_Exception::class);

        Zend_Pdf_Filter_Compression_Flate::decode('not compressed');
    }
}
