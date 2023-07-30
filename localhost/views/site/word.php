<?php

/** @var yii\web\View $this */

use yii\bootstrap5\Html;

$this->title = 'word';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="word">
	<form action="/site/word-save" method="POST" enctype="multipart/form-data">
		<input id="form-token" type="hidden" name="<?=Yii::$app->request->csrfParam?>"
		value="<?=Yii::$app->request->csrfToken?>"/>
		<!-- <input type="date" name="birth"> -->
		<input type="text" name="name" placeholder="Введите ФИО">
		<input type="number" name="value_1" placeholder="Введите оценку по профессиональные компетенции №1">
		<input type="number" name="value_2" placeholder="Введите оценку по профессиональные компетенции №2">
		<input type="number" name="value_3" placeholder="Введите оценку по профессиональные компетенции №3">
		<input type="number" name="value_4" placeholder="Введите оценку по профессиональные компетенции №4">
		<input type="number" name="value_5" placeholder="Введите оценку по профессиональные компетенции №5">
		<input type="number" name="value_6" placeholder="Введите оценку по профессиональные компетенции №6">
		<input type="number" name="value_7" placeholder="Введите оценку по профессиональные компетенции №7">
		<input type="number" name="value_8" placeholder="Введите оценку по профессиональные компетенции №8">
		<input type="number" name="value_9" placeholder="Введите оценку по профессиональные компетенции №9">
		<input type="number" name="value_10" placeholder="Введите оценку по профессиональные компетенции №10">
		<input type="number" name="value_11" placeholder="Введите оценку по профессиональные компетенции №11">
		<input type="number" name="value_12" placeholder="Введите оценку по профессиональные компетенции №12">
		<input type="number" name="value_13" placeholder="Введите оценку по профессиональные компетенции №13">
		<input type="number" name="value_14" placeholder="Введите оценку по профессиональные компетенции №14">
		<input type="number" name="value_15" placeholder="Введите оценку по профессиональные компетенции №15">
		<input type="number" name="grading_general" placeholder="Итоговая оценка по учебной/производственной практике">
	
		<button type="submit">Отправить</button>
	</form>
</div>