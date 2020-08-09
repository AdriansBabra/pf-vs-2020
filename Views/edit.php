<!DOCTYPE html>
<html>
<?php include './includes/header.php'; ?>
<title>Rediģēt</title>
<h1 style="font-style: italic;font-size:50px;text-align:center">Darāmo lietu saraksts</h1>
</div>
<h4 style="text-align:center;">Rediģēt</h4>
<div class="row justify-content-center">
    <form action="<?php $data[0]['id']?>" class="text-center border border-light p-5" method="POST">
        <div class="form-group">
            <label>Virsraksts</label>
            <input type="text" name="title" class="form-control mb-4" size="25" value="<?php echo $data[0]['title'] ?>">
        </div>
        <div class="form-group">
            <label>Apraksts</label>
            <input type="text" name="description" class="form-control mb-4" size="100" value="<?php echo $data[0]['description'] ?>">
        </div>
        <div class="second">
            <div class="col-md-12 text-center">
                <form>
            <button type="submit" class="btn btn-primary float-right">Saglabāt </button>
        <a href="home" class="input_form">
            <button onclick="href='../home';" type="button" name="submit" id="add_btn" class="btn btn-secondary float-left">Doties atpakaļ </button>
        </a>
        </div>
        </div>
    </form>
    </form>
</div>
</body>
<?php include './includes/stickedfooter.php' ?>
</html>