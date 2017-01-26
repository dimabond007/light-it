<!DOCTYPE html>
<html lang="en">
    <head>
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Главная</title>
        <link href="/template/css/bootstrap.min.css" rel="stylesheet">
        <link href="/template/css/font-awesome.min.css" rel="stylesheet">
        <link href="/template/css/main.css" rel="stylesheet">
        <link rel="shortcut icon" href="/template/images/1_logo.png">
    </head><!--/head-->

    <body>
            <div class="header-middle"><!--header-middle-->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="logo pull-left">
                                <a href="index.html"><img src="/template/images/2_logo.png" alt="" /></a>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="up-menu pull-right">
                                <ul class="nav navbar-nav"> 
                                    <?php if (User::isGuest()): ?> 
                                        <li><a href="/user/register"><i class="fa fa-pencil" aria-hidden="true"></i> Регистрация</a></li>                                   
                                        <li><a href="/user/login"><i class="fa fa-lock"></i> Вход</a></li>
                                    <?php else: ?>                               
                                        <li><a href="/user/logout"><i class="fa fa-unlock"></i> Выход</a></li>                                        
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/header-middle-->

            <div class="header-bottom"><!--header-bottom-->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div class="mainmenu pull-left">
                                <ul class="nav navbar-nav collapse navbar-collapse">
                                    <li><a href="/site/">Погода на сегодня</a></li>
                                    <li><a href="/feedback/index">Обратная связь</a></li> 
                                    <li><a href="/feedback/list">Список сообщений</a></li> 
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/header-bottom-->
            
        </header><!--/header-->