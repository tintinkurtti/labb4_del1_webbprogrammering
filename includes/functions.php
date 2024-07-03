<?php

class Post
{
    private $guest;
    private $message;
    private $date;

    //Constructor for the Post class
    public function __construct($guest, $message) {
        $this->guest = $guest;
        $this->message = $message;
        $this->date = date("Y-m-d H:i:s");
    }
    //Getters for the Post class
    public function getGuest() {
        return $this->guest;
    }
    public function getMessage() {
        return $this->message;
    }
    public function getDate() {
        return $this->date;
    }
}


class GuestBook
{
    private $posts = array();
    private $filename;

    public function __construct($filename) {
        $this->filename = $filename;
        if (file_exists($this->filename)) {
            $this->posts = unserialize(file_get_contents($this->filename));
        }
    }

    //Print the posts
    public function printPost() {
        if (!empty($this->posts)) {
            foreach ($this->posts as $index => $post) {
                echo "<div class='post'>";
                echo "<div class='post-content'>";
                echo "<p><strong>{$post->getGuest()}</strong>: {$post->getMessage()} <strong>Datum:</strong> {$post->getDate()}</p>";
                echo "</div>";
                //Create a form for the delete button
                echo "<form class='delete-form' method='post' action=''>";
                echo "<input type='hidden' name='delete_index' value='$index'>";
                echo "<input type='submit' value='Radera'>";
                echo "</form>";
                echo "</div>";
            }
        } else {
            echo "<p>Inga inlägg att visa.</p>";
        }
    }

    //Save the posts to the file
    public function savePosts() {
        file_put_contents($this->filename, serialize($this->posts));
    }

    //Make a new post with the guest and message
    public function makePost($guest, $message) {
        $post = new Post($guest, $message);
        $this->posts[] = $post;
        $this->savePosts();
    }

    //Delete the post with the index
    public function deletePost($index) {
        if (array_key_exists($index, $this->posts)) {
            unset($this->posts[$index]);
            $this->posts = array_values($this->posts);
            $this->savePosts();
        }
    }
}
