<link rel="stylesheet" href="/COMP1841/cw/films.css">
<h2>Edit Film</h2>

<form method="post" enctype="multipart/form-data">

<input type="hidden" name="id" value="<?= $film['id'] ?>">

Title
<input type="text" name="title" value="<?= $film['title'] ?>">

<br><br>

Image
<input type="file" name="image">

<br><br>

<img src="images/<?= $film['image'] ?>" width="100">

<br><br>

<input type="submit" value="Save">

</form>