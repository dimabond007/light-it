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
                    	<?php if (User::isGuest()): ?>
                    	<input type="text" name="name" placeholder="Имя" pattern=".{3,}" title="Не короче 3 символов" required/>
                        <input type="email" name="email" placeholder="E-mail" required/> 
						<?php else:?>
						<input type="text" name="name" placeholder="Имя" value="<?php echo $name?>" pattern=".{3,}" title="Не короче 3 символов" required/>
                        <input type="email" name="email" placeholder="E-mail"  value="<?php echo $email?>" required/>
                        <?php endif; ?>
                        <textarea maxlength="500" placeholder="Ваше сообщение" rows="20" name="msg" id="comment_text" cols="40" class="ui-autocomplete-input" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true" required></textarea>
                        </br></br>
                        <div class="g-recaptcha" data-sitekey="6LevmRMUAAAAAPXG8SuZYj5wkiRfJf1MsHH4GWjJ"></div>
                        </br>
                        <input type="submit" name="submit" class="btn btn-default" value="Отправить" />
                    </form>
                </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>