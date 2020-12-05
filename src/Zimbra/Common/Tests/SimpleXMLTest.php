<?php declare(strict_types=1);

namespace Zimbra\Common\Tests;

use PHPUnit\Framework\TestCase;;
use Zimbra\Common\SimpleXML;

/**
 * Testcase class for simple xml.
 */
class SimpleXMLTest extends TestCase
{
    private $_xmlString;

    protected function setUp(): void
    {
        $this->_xmlString = <<<EOT
<?xml version="1.0"?>
<books>
    <book title="Book 01" public="1999" publisher="Publisher 01">
        <author name="Author 01"/>
        <author name="Author 02"/>
    </book>
    <book title="Book 02" public="1999" publisher="Publisher 02">
        <author name="Author 04"/>
    </book>
    <book title="Book 03" public="1999" publisher="Publisher 03">
        <author name="Author 01"/>
        <author name="Author 03"/>
    </book>
</books>
EOT;
    }

    public function testToObject()
    {
        $xml = new SimpleXML($this->_xmlString);
        $books = $xml->toObject();
        $this->assertObjectHasAttribute('book', $books);
        $this->assertIsArray($books->book);
        $this->assertCount(3, $books->book);
        foreach ($books->book as $book)
        {
            $this->assertObjectHasAttribute('title', $book);
            $this->assertStringStartsWith('Book 0', $book->title);

            $this->assertObjectHasAttribute('public', $book);
            $this->assertSame('1999', $book->public);

            $this->assertObjectHasAttribute('publisher', $book);
            $this->assertStringStartsWith('Publisher 0', $book->publisher);

            $this->assertObjectHasAttribute('author', $book);
            if(!is_array($book->author))
            {
                $this->assertObjectHasAttribute('name', $book->author);
                $this->assertStringStartsWith('Author 0', $book->author->name);
            }
            else
            {
                foreach ($book->author as $author)
                {
                    $this->assertObjectHasAttribute('name', $author);
                    $this->assertStringStartsWith('Author 0', $author->name);
                }
            }
        }
    }

    public function testAppend()
    {
        $xmlString = <<<EOT
<?xml version="1.0"?>
<books>
    <book title="Book Title" public="1999" publisher="Book Publisher">
        <author><name>Author 01</name></author>
        <author name="Author 02" />
    </book>
</books>
EOT;
        $xml = new SimpleXML('<books />');
        $book = new SimpleXML('<book />');
        $book->addAttribute('title', 'Book Title')
             ->addAttribute('public', '1999')
             ->addAttribute('publisher', 'Book Publisher');
        $book->addChild('author')->addChild('name', 'Author 01');
        $book->addChild('author')->addAttribute('name', 'Author 02');
        $xml->append($book);
        $this->assertXmlStringEqualsXmlString($xmlString, $xml->asXml());
    }

    public function testAddArray()
    {
        $books = [
            'book' => [
                [
                    'title' => 'Book 01',
                    'public' => 1999,
                    'publisher' => 'Publisher 01',
                    'author' => [
                        ['name' => 'Author 01'],
                        ['name' => 'Author 02'],
                    ],
                ],
                [
                    'title' => 'Book 02',
                    'public' => 1999,
                    'publisher' => 'Publisher 02',
                    'author' => [
                        'name' => 'Author 04',
                    ],
                ],
                [
                    'title' => 'Book 03',
                    'public' => 1999,
                    'publisher' => 'Publisher 03',
                    'author' => [
                        ['name' => 'Author 01'],
                        ['name' => 'Author 03'],
                    ],
                ],
            ],
        ];
        $xml = new SimpleXML('<books />');
        $xml->addArray($books);
        $this->assertXmlStringEqualsXmlString($this->_xmlString, $xml->asXml());
    }

    public function testAddChildWithCData()
    {
        $xml = new SimpleXML('<book />');
        $title = $xml->addChildWithCData('title', 'Book Title');
        $this->assertSame('<title><![CDATA[Book Title]]></title>', $title->asXml());

        $publisher = $xml->addChild('publisher');
        $publisher->addCData('Book Publisher');
        $this->assertSame('<publisher><![CDATA[Book Publisher]]></publisher>', $publisher->asXml());
    }
}
