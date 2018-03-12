<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">
				
                <div class="signup-form"><!--sign up form-->
                    <h2>Обратная связь</h2>
                    <?php if (isset($errors) && is_array($errors)): ?>
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li> - <?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
               		<?php endif; ?>

                    <form action="#" method="post">
                    	<input type="text" name="name" placeholder="Имя" pattern=".{3,}" title="Не короче 3 символов" required/>
                        <input type="hidden"  name="parent_id" value="<? echo isset($_GET['parent_id']) ? $_GET['parent_id'] : 0 ;?>"/> 
                        <textarea maxlength="500" placeholder="Ваше сообщение" rows="5" name="msg" id="comment_text" cols="40" class="ui-autocomplete-input" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true" required></textarea>
                        <input type="submit" name="submit" class="btn btn-default" value="Отправить" />
                    </form>
                </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>