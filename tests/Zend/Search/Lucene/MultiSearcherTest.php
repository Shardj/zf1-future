<?php

use Yoast\PHPUnitPolyfills\TestCases\TestCase;

require_once 'Zend/Search/Lucene.php';
require_once 'Zend/Search/Lucene/MultiSearcher.php';

/**
 * @category   Zend
 * @package    Zend_Search_Lucene
 * @subpackage UnitTests
 * @group      Zend_Search_Lucene
 */
class Zend_Search_Lucene_MultiSearcherTest extends TestCase
{
    /**
     * @var Zend_Search_Lucene_Interface
     */
    protected $_first;

    /**
     * @var Zend_Search_Lucene_MultiSearcher
     */
    protected $_searcher;

    protected function set_up()
    {
        $this->_first = Zend_Search_Lucene::open(dirname(__FILE__) . '/_indexSample/_files');

        $this->_searcher = new Zend_Search_Lucene_MultiSearcher([$this->_first]);
        $this->_searcher->addIndex(Zend_Search_Lucene::open(dirname(__FILE__) . '/_index23Sample/_files'));
    }

    protected function tear_down()
    {
        Zend_Search_Lucene::setDefaultSearchField(null);
        Zend_Search_Lucene::setResultSetLimit(0);
    }

    public function testCountsAreTheSumsOfTheIndices()
    {
        $this->assertSame(20, $this->_searcher->count());
        $this->assertSame(20, $this->_searcher->maxDoc());
        $this->assertSame(18, $this->_searcher->numDocs());
    }

    public function testFindReturnsTheHitsOfAllIndicesWithShiftedIds()
    {
        $ids = [];
        foreach ($this->_searcher->find('submitting') as $hit) {
            $ids[] = $hit->id;
        }
        sort($ids);

        $firstIds = [];
        foreach ($this->_first->find('submitting') as $hit) {
            $firstIds[] = $hit->id;
        }
        sort($firstIds);

        $expected = $firstIds;
        foreach ($firstIds as $id) {
            // both sample indices hold the same documents
            $expected[] = $id + $this->_first->count();
        }

        $this->assertSame($expected, $ids);
    }

    public function testTermDataIsIndexedByTheShiftedDocumentId()
    {
        $term = new Zend_Search_Lucene_Index_Term('submitting', 'contents');

        $this->assertSame([2, 6, 7, 8, 12, 16, 17, 18], $this->_searcher->termDocs($term));
        $this->assertSame(
            [2 => 3, 6 => 3, 7 => 2, 8 => 2, 12 => 3, 16 => 3, 17 => 2, 18 => 2],
            $this->_searcher->termFreqs($term)
        );

        $positions = $this->_searcher->termPositions($term);
        $this->assertSame([2, 6, 7, 8, 12, 16, 17, 18], array_keys($positions));
        $this->assertSame($this->_first->termPositions($term)[2], $positions[2]);
        $this->assertSame($positions[2], $positions[12]);

        $this->assertTrue($this->_searcher->hasTerm($term));
        $this->assertSame(8, $this->_searcher->docFreq($term));
    }

    public function testTermsReturnsEveryTermOnce()
    {
        $keys = [];
        foreach ($this->_searcher->terms() as $term) {
            $keys[] = $term->key();
        }

        $this->assertSame(count($keys), count(array_unique($keys)));
        $this->assertGreaterThanOrEqual(count($this->_first->terms()), count($keys));
    }

    public function testGetDocumentTakesTheShiftedId()
    {
        $this->assertEquals(
            $this->_first->getDocument(2)->getFieldValue('path'),
            $this->_searcher->getDocument(2)->getFieldValue('path')
        );
        $this->assertInstanceOf(Zend_Search_Lucene_Document::class, $this->_searcher->getDocument(12));
    }

    /**
     * The default search field and the result set limit are static, as in Zend_Search_Lucene_Interface
     */
    public function testDefaultSearchFieldAndResultSetLimitAreShared()
    {
        Zend_Search_Lucene_MultiSearcher::setDefaultSearchField('contents');
        $this->assertSame('contents', Zend_Search_Lucene::getDefaultSearchField());
        $this->assertSame('contents', Zend_Search_Lucene_MultiSearcher::getDefaultSearchField());

        Zend_Search_Lucene_MultiSearcher::setResultSetLimit(3);
        $this->assertSame(3, Zend_Search_Lucene::getResultSetLimit());
        $this->assertSame(3, Zend_Search_Lucene_MultiSearcher::getResultSetLimit());
    }
}
