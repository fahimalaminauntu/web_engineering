<?php

class Book
{
    public $title;
    public $author;
    public $available;

    public function __construct($title, $author, $available = true)
    {
        $this->title = $title;
        $this->author = $author;
        $this->available = $available;
    }

    public function isAvailable()
    {
        return $this->available ? "Available" : "Not Available";
    }

    public function getInfo()
    {
        return "Title: $this->title, Author: $this->author, Status: " . $this->isAvailable();
    }
}

$book1 = new Book("দেবদাস, পল্লীসমাজ, শ্রীকান্ত, গৃহদাহ", "শরৎচন্দ্র চট্টোপাধ্যায়", true);
$book2 = new Book("চোখের বালি, নৌকাডুবি, যোগাযোগ, শেষের কবিতা", "রবীন্দ্রনাথ ঠাকুর", false);
$book3 = new Book("বাঁধনহারা, মৃত্যুক্ষুধা, কুহেলিকা", "কাজী নজরুল ইসলাম", true);
$book4 = new Book("দিবারাত্রির কাব্য, পদ্মা নদীর মাঝি, পুতুল নাচের ইতিকথা", "মানিক বন্দ্যোপাধ্যায়", false);

$books = [$book1, $book2, $book3, $book4];

function showBookList($books)
{
    echo "<h3>Book List</h3>";
    echo "<ul>";
    foreach ($books as $book) {
        echo "<li>" . $book->getInfo() . "</li>";
    }
    echo "</ul>";
}

showBookList($books);

?>