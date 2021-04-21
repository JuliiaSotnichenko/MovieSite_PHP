<?php
include_once "database.php";
session_start();
if ($conn) {
    $query = 'SELECT * FROM movies';

    $results = mysqli_query($conn, $query);

    $movies = mysqli_fetch_all($results, MYSQLI_ASSOC);
}
if (isset($_POST["stopPlaylist"])) {
    unset($_SESSION["playlistid"]);
}

?>
<header>
    <div class="navButtons">
        <a class="active" href="homePage.php">HomePage</a>
        <a href="catalogue.php">Catalogue</a>
        <?php
        if (isset($_SESSION["isAdmin"])) {
            if ($_SESSION["isAdmin"] == 1) {
                echo "<a href='insertCategory.php'>Manage Categories</a>";
                echo "<a href='insertFilm.php'>Add a film</a>";
            }
        }
        if (isset($_SESSION['mail'])) {
            echo '<a href="playlist.php">Playlist</a>';
            echo "<a href='logout.php'>Log out</a>";
        } else {
            echo "<a href='login.php'>Log In</a>";
        }
        ?>
    </div>
    <?php if (isset($_SESSION["playlistid"])) : ?>
        <form action="" method="POST">
            <input type="submit" value="Stop editing playlist" name="stopPlaylist">
        </form>
    <?php endif; ?>
    <form action="details.php" method="post">
        <input list="movie" name="search" id="movies">
        <datalist id="movie">
            <?php foreach ($movies as $movie) : ?>
                <option value="<?= $movie["title"]; ?>">
                <?php endforeach; ?>
        </datalist>
        <input type="submit" class="btnsearch" value="Search">
    </form>

</header>
<hr>

<script>
    $(document).ready(function() {
        var active;
        $("div").click(function() {
            active = $(":active");
            setTimeout(function() {
                console.log("active", active)
            }, 1000)
        })
    })
</script>