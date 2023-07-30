<?php
/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;



AppAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?= Html::encode($this->title) ?></title>
  
  <?php $this->registerCsrfMetaTags(); ?>
  <link rel="shortcut icon" href="images/favicon.png" />
  
  <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>


<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="navbar-brand-wrapper d-flex justify-content-center">
            <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
              <!-- <p>Practice </p> -->
                <a class="navbar-brand brand-logo" ><img src="/images/логотип.png" alt="logo"/></a>
                <a class="navbar-brand brand-logo-mini" ><img src="/images/логотип.png"
                                                                               alt="logo"/></a>
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-sort-variant"></span>
                </button>
            </div>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
            <ul class="navbar-nav mr-lg-4 w-100">
                <li class="nav-item nav-search d-none d-lg-block w-100">

                </li>
            </ul>
            <?php if (!Yii::$app->user->isGuest) : ?>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                            <span class="nav-profile-name"><?= Yii::$app->user->identity->login; ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                             aria-labelledby="profileDropdown">
                            <a class="dropdown-item">
                                <?php
                                echo Html::beginForm(['/site/logout'])
                                    . Html::submitButton(
                                        'Выход (' . Yii::$app->user->identity->login . ')',
                                        ['class' => 'nav-link btn btn-link logout']
                                    )
                                    . Html::endForm()
                                ?>
                                <i class="nav-link btn btn-link logout"></i>
                            </a>
                        </div>
                    </li>
                </ul>
            <?php endif; ?>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <!-- <li class="nav-item">
            <a class="nav-link" href="/blog">
              <i class="mdi mdi-home menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li> -->
          <!-- !(Yii::$app->user->isGuest || Yii::$app->user->identity->IsAdmin) -->
          <!-- <li class="nav-item">
            <a class="nav-link" href="/forms">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Forms</span>
            </a>
          </li> -->
         
          <?php if ( Yii::$app->user->can('per_student')) :?>  
          <li class="nav-item">
            <a class="nav-link" href="/icons">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Резюме</span>
            </a>
          </li>
          <?php endif; ?> 

          <?php if (  Yii::$app->user->can('admin')) :?>  
          <li class="nav-item">
            <a class="nav-link" href="/specialization">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Специальности</span>
            </a>
          </li>
          <?php endif; ?> 

          <?php if (  Yii::$app->user->can('admin') || Yii::$app->user->can('per_employer')) :?>  
          <li class="nav-item">
            <a class="nav-link" href="/practice-group/main">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Практика групп</span>
            </a>
          </li>
          <?php endif; ?> 

          <!-- < if ( Yii::$app->user->can('admin') || Yii::$app->user->can('per_student')) :?> -->
          <!-- <li class="nav-item">
            <a class="nav-link" href="/placepractice">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Место практики</span>
            </a>
          </li> -->
          <!-- < endif; ?>  -->
          <?php if (  Yii::$app->user->can('admin')) :?> 
          <li class="nav-item">
            <a class="nav-link" href="/documents">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Документы по практике</span>
            </a>
          </li>
          <?php endif; ?> 
          <?php if ( Yii::$app->user->can('per_employer') || Yii::$app->user->can('per_student') ) :?>  
          <li class="nav-item">
            <a class="nav-link" href="/application">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Заявка на практику</span>
            </a>
          </li>
          <?php endif; ?> 
          <!-- <li class="nav-item">
            <a class="nav-link" href="/applicationstud">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Заявка от студ.</span>
            </a>
          </li> -->
          <?php if (  Yii::$app->user->can('admin')) :?> 
          <li class="nav-item">
            <a class="nav-link" href="/organization">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Организации</span>
            </a>
          </li>
          <?php endif; ?>
          <?php if (  Yii::$app->user->can('admin') || Yii::$app->user->can('per_student')) :?> 
          <li class="nav-item">
            <a class="nav-link" href="/user-interprise">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Списки работодателей</span>
            </a>
          </li>
          <?php endif; ?>
          <!-- <li class="nav-item">
            <a class="nav-link" href="/post">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Должности</span>
            </a>
          </li> -->


          <!-- < endif; ?>  -->
          <!-- < if ( Yii::$app->user->can('per_employer')) :?> -->
          <!-- <li class="nav-item">
            <a class="nav-link" href="/student-lists">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Списки студентов</span>
            </a>
          </li> -->
          <!-- < endif; ?>  -->
          <!-- <li class="nav-item">
            <a class="nav-link" href="/place-enterprises">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Места предприятий</span>
            </a>
          </li> -->
          <?php if (  Yii::$app->user->can('admin')) :?> 
          <li class="nav-item">
            <a class="nav-link" href="/student-to-list">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Списки студентов</span>
            </a>
          </li>
          <?php endif; ?> 

          <!-- < if ( Yii::$app->user->can('per_student')) :?> -->
          <!-- <li class="nav-item">
            <a class="nav-link" href="/employer-lists">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Списки работодателей</span>
            </a>
          </li> -->
          <!-- < endif; ?> -->
          <?php if( !Yii::$app->user->isGuest && Yii::$app->user->can('per_student') ): ?>  
            <li class="nav-item">
              <a class="nav-link" href="/student-profile">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Данные по практике</span>
              </a>
            </li>
          <?php endif ?>  


          <li class="nav-item">
            <a class="nav-link" href="/site/about">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">О нас</span>
            </a>
          </li>
          <?php if (Yii::$app->user->isGuest) : ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false"
                           aria-controls="auth">
                            <i class="mdi mdi-account menu-icon"></i>
                            <span class="menu-title">Страницы пользователя</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="auth">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"><a class="nav-link" href="/site/login"> Авторизация </a></li>
                                <li class="nav-item"><a class="nav-link" href="/site/register"> Регистрация</a></li>
                            </ul>
                        </div>
                    </li>
                <?php endif; ?>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">

          <?= Alert::widget() ?>
          
          <?= $content ?>
          </div>
          
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
       

        <!-- partial -->
      </div>
      
      <!-- main-panel ends -->
    </div>
    
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

 
  <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>

