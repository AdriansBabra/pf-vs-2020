
<!DOCTYPE html>
<html>
<?php include './includes/header.php';
?>
<?php if (isset($_SESSION['message'])) : ?>
    <div class="alert alert-<?php echo $_SESSION['message']['type'] ?>" role="alert">
        <?php echo $_SESSION['message']['text'] ?>
    </div>
<?php endif; ?>

<title>Home</title>
<h1 style="font-style: italic;font-size:50px;text-align:center">Darāmo lietu saraksts</h1>
<?php
foreach($data as $todo) {
    echo '
<div class="card bg-light mb-3 mx-auto" style="max-width: 26rem;">
  <div class="card-body">
                        <h5 class="card-title text-center font-weight-bold">'.$todo['title'].'</h5>
                        <p class="card-text">'.$todo['description'].'</p>
                        <p class="card-text font-weight-bolder small" style="float:left";>Created:'.$todo['created_at'].'</p>
                        <a href="edit/'.$todo['id'].'" class="btn btn-primary btn-lg pull-right" style="float:right;">Labot</a>
                        <form action="delete/'.$todo['id'].'" method="POST">
                            <button href="#" class="btn btn-danger btn-lg pull-right" style="float:right;">Dzēst</button>
                        </form>
                    </div>
                    </div>
    ';
}
?>
<div class="container">
    <div class="row">
        <div class="col text-center">
            <a href="create" method="post" action="index.php" class="input_form">
                <button type="button" name="submit" id="add_btn" class="btn btn-secondary btn-lg float-center mx-auto";">Pievienot jaunu </button>
            </a>
        </div>
    </div>
</div>
</body>
<?php include './includes/footer.php' ?>
</html>
