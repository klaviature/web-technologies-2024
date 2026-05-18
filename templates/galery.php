<?php if (!empty($upload_result)): ?>

    <div class="upload-message">

        <h2><?=$upload_result?></h2>

    </div>

<?php endif; ?>

<h2>Загрузить изображение</h2>

<form
    method="POST"
    enctype="multipart/form-data"
    onsubmit="return checkFileSize()"
>

    <input
        type="file"
        name="image"
        id="imageInput"
        required
    >

    <input type="submit" value="Загрузить">

</form>

<script>

    function checkFileSize() {

        const file =
            document.getElementById('imageInput').files[0];

        const maxSize = 10 * 1024 * 1024;

        if (file && file.size > maxSize) {

            alert('Файл слишком большой');

            return false;
        }

        return true;
    }

</script>

<hr>

<h2>Галерея</h2>

<div class="gallery">

    <?php foreach ($images as $image): ?>

        <a
            href="/image.php?type=big&file=<?=$image?>"
            target="_blank"
        >

            <img
                src="/image.php?type=small&file=<?=$image?>"
                width="300"
            >

        </a>

    <?php endforeach; ?>

</div>