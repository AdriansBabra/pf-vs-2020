<!DOCTYPE html>
<html>
<?php include './includes/header.php'; ?>
<title>Pievienošana</title>
<h1 style="font-style: italic;font-size:50px;text-align:center">Darāmo lietu saraksts</h1>
</div>
<h4 style="text-align:center;">Pievienot jaunu </h4>
<div class="container">
    <form action="create" class="text-center border border-light p-5" method="POST">
         <div class="form-group">
         <label>Virsraksts</label>
             <textarea class="form-control" rows="1" name="title" placeholder="Lūdzu ierakstiet virsrakstu"></textarea>
         </div>
    <div class="form-group">
    <label>Apraksts</label>
        <textarea class="form-control" rows="5" name="description" placeholder="Lūdzu ierakstiet aprakstu"></textarea>
    </div>
        <div class="second">
            <div class="col-md-12 text-center">
                <form>
                    <button onclick="href='home';" type="submit" href="index.php" name="pievienot" class="btn btn-primary float-right">Pievienot </button>
                    <a href="home" method="post" action="create" class="input_form">
                        <button type="button" name="submit" id="add_btn" class="btn btn-secondary float-left">Doties atpakaļ </button>
                    </a>
                </form>
            </div>
        </div>
    </form>
</div>
</body>
<?php include './includes/stickedfooter.php' ?>
</html>