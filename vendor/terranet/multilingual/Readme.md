# Description

This package provides basic application replacement package in order to add Multilingual Support for Laravel 5 Framerowk

## Introduction

`composer require terranet/multilingual`

**! Important:** Since the `RoutingServiceProvider` is Hardcoded in the laravel Application there is no way to extend it.

So the main idea is to replace Laravel's Application with extended one

## Installation

open file bootstrap/app.php

Replace line

`$app = new Illuminate\Foundation\Application(`

with

`$app = new Terranet\Multilingual\Application(`


## Service provider registration

open config/app.php

find and replace line

`Illuminate\Translation\TranslationServiceProvider`

with

`Terranet\Multilingual\MultilingualServiceProvider`


## Usage

now you should be able to use custom features `Route::multilingual` method to group routes that should have multilingual support

    Route::multilingual(function()
    {
      Route::get('/category', function()
      {
        return Lang::slug();
      })
    })

All attributes of current language are accessible by following methods:

    Lang::getPublic() - all public languages
    Lang::ids() - public languages ids
    Lang::lists() - public languages slugs
    
    Lang::id()
    Lang::slug()
    Lang::title()
    Lang::isValid()


Also some additional URL methods are available

    URL::lang_to($path, $extra = array(), $secure = null, $langCode = null)

can be used to Generate an absolute URL to the given path, with the current language code

    URL::lang_switch($langCode, $extra = array(), $secure = null) 
    
can be used to Generate an absolute URL of the current URL but in another language.

so, `URL::lang_to('home')` will generate /en/home, when current lang is "en"
and `URL::lang_switch('ro')` will generate current url (@ex: /home) with language segment /ro/home