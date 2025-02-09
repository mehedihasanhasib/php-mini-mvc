<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Mini MVC</title>
</head>

<body>
    <form action="/file" method="post" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Enter file name">
        <input type="hidden" name="_token" value="<?= csrf_token(); ?>">
        <input type="file" name="file">
        <button type="submit">Submit</button>
    </form>
</body>

</html>