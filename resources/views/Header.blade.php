<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Back End Developer - Task</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="robots" content="index, follow"/>
        <meta name="keywords" content="<?php if(!empty(Request::segment(2))) { echo Request::segment(2); } ?>"/>
        <meta name="description" content=""/>
		<meta name="csrf-token" content="{{ csrf_token() }}" />		
		<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}" />
		<link rel="stylesheet" type="text/css" href="{{ asset('css/loader.css') }}" />				
    </head>