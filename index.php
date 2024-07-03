<?php
$page_title = "Visitors";
include("includes/header.php");
include("includes/functions.php");
$posts = new GuestBook("file.txt");
//If the delete_index is set, delete the post with the index and save the posts
if (isset($_POST['delete_index'])) {
    $posts->deletePost($_POST['delete_index']);
}
//If the publish button is set, make a new post with the guest and message
if (isset($_POST["publish"])) {
    $guest = $_POST["guest"];
    $message = $_POST["message"];
    $posts->makePost($guest, $message);
}
?>
    <h2>Gästbok</h2>
<?php
//Print the posts
$posts->printPost();
?>
    <h3>Skapa inlägg</h3>
    <form method="post" action="">
        <label for="guest"><b>Namn:</b></label><br>
        <input type="text" name="guest" id="guest" required><br>
        <label for="message"><b>Meddelande:</b></label><br>
        <textarea name="message" id="message" rows="4" cols="50" required></textarea><br>
        <input type="submit" name="publish" value="Publicera">
    </form>



