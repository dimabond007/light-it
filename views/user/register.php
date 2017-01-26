<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <div class="col-sm-4 col-sm-offset-4 padding-right">
            
                <?php if ($result): ?>
                    <p>Вы зарегистрированы!</p>
                <?php else: ?>
                    <?php if (isset($errors) && is_array($errors)): ?>
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li> - <?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                <div class="signup-form">
                    <h2>Регистрация на сайте</h2>
                    <form action="#" method="post">
                        <input type="text" name="name" placeholder="Имя" value="<?php $name ?>" pattern=".{3,}" title="Не короче 3 символов" required/>
                        <input type="text" name="surname" placeholder="Фамилия" value="<?php $surname ?>"  pattern=".{3,}" title="Не короче 3 символов"  required/>
                        <input type="email" name="email" placeholder="E-mail" value="<?php $email ?>" required/>
                        <input type="password" name="password" placeholder="Пароль" value="<?php $password ?>"  pattern=".{6,}" title="Не короче 6 символов" required/>
                        <input type="tel" pattern="\d{12}$" name="phone" placeholder="Телефон" title="380xxxxxxxxx" value="<?php $phone ?>" required/>
                        
                        <div>Дата рождения</div>
                        <input type="date" name="birthday" value="<?php $birthday ?>" required/>
                        <div>Пол</div>
                        
                        <select name="gender" placeholder="Пол" >
                            <option>Мужской</option>
                            <option>Женский</option>
                        </select>                       
                        <div>&nbsp</div>

                        <input type="submit" name="submit" class="btn btn-default" value="Регистрация" />
                    </form>
                </div>
                <?php endif; ?>
                <br/>
                <br/>
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>