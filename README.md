TangoMan Front Bundle
=====================

**TangoMan Front Bundle** provides an easy way to add front elements to your pages.
**TangoMan Front Bundle** makes building back-office for your app a brease.

Features
========

- Navigation bar
    - Dropdown
- Menus
- Tabs
- Buttons
- Search forms
    - Inputs
    - Selects
    - Options
        - Optgroups
    - Checkboxes
    - Radio buttons
    - Reset button
    - Submit button

All elements can :

- Own class
- Own id

Links, buttons, menu items, tabs can :

- Own icons
- Own translatable labels
- Own badges
- Own parameters
- Be disabled
- Be displayed on specific pages
- Be firewalled
- Trigger callbacks
- Show tooltips
- Toggle popovers
- Toggle modals
- Toggle dropdowns
- Toggle accordion

And buttons can :

- Submit form on change

You can easily create your own template as well.

Installation
============

Step 1: Download the Bundle
---------------------------

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```bash
$ composer require tangoman/front-bundle
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Step 2: Enable the Bundle
-------------------------

Then, enable the bundle by adding it to the list of registered bundles
in the `app/AppKernel.php` file of your project:

```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    // ...

    public function registerBundles()
    {
        $bundles = array(
            // ...
            new TangoMan\FrontBundle\TangoManFrontBundle(),
            new TangoMan\CallbackBundle\TangoManCallbackBundle(),
        );

        // ...
    }
}
```

Since **TangoMan Front Bundle** requires **[TangoMan Callback Bundle](https://github.com/TangoMan75/CallbackBundle)** enable it in the `app/AppKernel.php` as well.

Usage
=====

Front Assets
------------

Assets should copy automatically, if for whatever reason you need to reinstall them manually type following command :

```console
$ php bin/console assets:install TangoManFrontBundle
```

In order for elements to display properly include the following `<link>` tag in your `::base.html.twig`
Wich will enable **TangoMan Front Bundle** custom css. (You can use your own css is you want to.)
```twig
{% block stylesheet %}
    {{ parent() }}
    <link rel="stylesheet" href="{{ asset('bundles/tangomanfront/css/tangoman-front-bundle.css') }}">
{% endblock %}
```
In order for forms to behave like expected include the following `<script>` tags inside your javascript block.
```twig
{% block javascript %}
    {{ parent() }}
    <script src="{{ asset('bundles/tangomanfront/js/tangoman-front-bundle.js') }}"></script>
{% endblock %}
```

Navbar component
----------------

If you're using default navbar template,
name your routes like the following:

 - 'app_login'
 - 'app_check'
 - 'app_logout'
 - 'app_user_profile'
 - 'app_user_edit'
 - 'app_admin_index'
 - 'homepage'

Search / filter form component
------------------------------

### Place use statement in the controller

```php
use TangoMan\FrontBundle\Model\Button;
use TangoMan\FrontBundle\Model\ButtonGroup;
use TangoMan\FrontBundle\Model\Item;
use TangoMan\FrontBundle\Model\Menu;
use TangoMan\FrontBundle\Model\Modal;
use TangoMan\FrontBundle\Model\SearchForm;
use TangoMan\FrontBundle\Model\SearchInput;
use TangoMan\FrontBundle\Model\SearchOption;
use TangoMan\FrontBundle\Model\Th;
use TangoMan\FrontBundle\Model\Thead;
```

### Build object in the controller

```php
<?php
// AppBundle/Controller/DefaultController.php
namespace AppBundle\Controller;

// ...

class DefaultController extends Controller
{
    /**
     * @Route("/user/index")
     */
    public function indexAction()
    {
        // ...

        $form = new SearchForm();

        // Number
        $input = new SearchInput();
        $input->setLabel('Id')
            ->setName('e-id')
            ->setType('number');
        $form->addInput($input);

        // Text
        $input = new SearchInput();
        $input->setLabel('User')
            ->setName('user-username')
            ->setType('text');
        $form->addInput($input);

        // Select
        $input = new SearchInput();
        $input->setLabel('Role')
            ->setName('roles-type')
            ->setPlaceholder('All')
            ->setType('select');

        $option = new SearchOption();
        $option->setName('Administrator')
            ->setValue('ROLE_ADMIN');
        $input->addOption($option);

        $option = new SearchOption();
        $option->setName('User')
            ->setValue('ROLE_USER');
        $input->addOption($option);
        $form->addInput($input);

        // Submit
        $input = new SearchInput();
        $input->setLabel('Filter')
            ->setType('submit')
            ->setIcon('glyphicon glyphicon-search');
        $form->addInput($input);

        return $this->render(
            'user/index.html.twig',
            [
                'form' => $form,
                'users' => $users,
            ]
        );
    }
}
```

### Integrate in Twig

```twig
<div id="search-form" class="jumbotron">
    {{ searchForm(form) }}
</div>
```

Ordered list component
----------------------

```twig
<table class="table table-striped">
    {{ thead(thead) }}
    <tbody>
    {% for user in users %}
        <tr>
            <td>
            ...
```

Inputs
------

|  Attribute  |   Status  |          Default value           |
|-------------|-----------|----------------------------------|
| class       | optional  | form-control                     |
| disabled    | optional  | null                             |
| icon        | optional  | null                             |
| id          | optional  | tango-input-{{ input.name }}     |
| label       | optional  | null                             |
| name        | mandatory | null                             |
| pages       | optional  | []                               |
| placeholder | optional  | null                             |
| roles       | optional  | ['IS_AUTHENTICATED_ANONYMOUSLY'] |
| submit      | optional  | false                            |
| type        | optional  | text                             |
| value       | auto      | app.request.get(input.name)      |

Selects
-------

|  Attribute  |   Status  |          Default value           |
|-------------|-----------|----------------------------------|
| class       | optional  | 'form-control'                   |
| disabled    | optional  | null                             |
| icon        | optional  | null                             |
| id          | optional  | tango-select-{{ input.name }}    |
| label       | optional  | null                             |
| name        | mandatory | null                             |
| options     | optional  | null                             |
| pages       | optional  | []                               |
| placeholder | optional  | null                             |
| roles       | optional  | ['IS_AUTHENTICATED_ANONYMOUSLY'] |
| submit      | optional  | false                            |
| type        | optional  | 'text'                           |

Buttons
-------

| Attribute  |   Status  |          Default value           |
|------------|-----------|----------------------------------|
| attributes | optional  | null                             |
| badge      | optional  | null                             |
| class      | optional  | 'btn btn-primary'                |
| data       | optional  | null                             |
| disabled   | optional  | null                             |
| href       | optional  | null                             |
| icon       | optional  | null                             |
| id         | optional  | null                             |
| label      | optional  | null                             |
| pages      | optional  | []                               |
| parameters | optional  | null                             |
| roles      | optional  | ['IS_AUTHENTICATED_ANONYMOUSLY'] |
| route      | mandatory | null                             |

Links
-----

| Attribute  |   Status  |          Default value           |
|------------|-----------|----------------------------------|
| attributes | optional  | null                             |
| badge      | optional  | null                             |
| class      | optional  | null                             |
| data       | optional  | null                             |
| disabled   | optional  | null                             |
| href       | optional  | null                             |
| icon       | optional  | null                             |
| id         | optional  | null                             |
| label      | optional  | null                             |
| pages      | optional  | []                               |
| parameters | optional  | null                             |
| roles      | optional  | ['IS_AUTHENTICATED_ANONYMOUSLY'] |
| route      | mandatory | null                             |

Options
-------

| Attribute |   Status  |          Default value           |
|-----------|-----------|----------------------------------|
| disabled  | optional  | null                             |
| id        | optional  | null                             |
| name      | mandatory | null                             |
| pages     | optional  | []                               |
| roles     | optional  | ['IS_AUTHENTICATED_ANONYMOUSLY'] |
| value     | mandatory | null                             |

Examples
========

Inputs
------

```json
"inputs": [
    {
        "type": "text",
        "icon": "glyphicon glyphicon-user",
        "name": "user-username",
        "label": "User"
    },
    {
        "type": "email",
        "icon": "glyphicon glyphicon-envelope",
        "name": "user-email",
        "label": "Email"
    }
]
```

Selects
-------

```json
"inputs": [
    {
        "type": "select",
        "name": "roles-type",
        "label": "Role",
        "icon": "glyphicon glyphicon-king",
        "placeholder": "All roles",
        "options": [
            {
                "name": "Super Admin",
                "value": "ROLE_SUPER_ADMIN"
            },
            {
                "name": "Admin",
                "value": "ROLE_ADMIN"
            },
            {
                "name": "Super User",
                "value": "ROLE_SUPER_USER"
            },
            {
                "name": "User",
                "value": "ROLE_USER"
            }
        ]
    }
]
```

Optgroups
---------

```json
"inputs": [
    {
        "type": "select",
        "name": "foo",
        "label": "Test",
        "icon": "fa fa-facebook",
        "placeholder": "Test",
        "optgroups": [
            {
                "label": "FooGroup",
                "options": [
                    {
                        "name": "Foo 1",
                        "value": "foo1"
                    },
                    {
                        "name": "Foo 2",
                        "value": "foo2"
                    }
                ]
            },
            {
                "label": "BarGroup",
                "disabled": true,
                "options": [
                    {
                        "name": "Bar 1",
                        "value": "bar1"
                    },
                    {
                        "name": "Bar 2",
                        "value": "bar2"
                    }
                ]
            }
        ]
    }
]
```

Buttons
-------

```json
"buttons": [
   {
       "icon": "glyphicon glyphicon-edit",
       "label": "Edit",
       "class": "btn btn-warning btn-sm",
       "route": "app_admin_user_edit",
       "tooltip": "Edit '~user~' profile",
       "parameters": {
           "id": '~user.id~'
       },
       "roles": ["ROLE_ADMIN","ROLE_SUPER_ADMIN"]
   },
   {
       "icon": "glyphicon glyphicon-trash",
       "label": "Delete",
       "class": "btn btn-danger btn-sm",
       "route": "app_admin_user_delete",
       "parameters": {
           "id": '~user.id~'
       },
       "tooltip": "Delete '~user~' profile",
       "modal": ".my-modal",
       "roles": ["ROLE_ADMIN","ROLE_SUPER_ADMIN"]
   }
]
```

Button Groups
-------------

```json
"inputs": [
    {
        "type": "buttonGroup",
        "class": "pull-right",
        "buttons": [
            {
                "type": "submit",
                "label": "Filter",
                "badge": '~users|length~',
                "icon": "glyphicon glyphicon-search"
            },
            {
                "type": "reset",
                "label": "Reset",
                "icon": "glyphicon glyphicon-remove",
                "class": "btn btn-warning"
            }
        ]
    }]
```

**TangoMan Front Bundle** classes
=================================

- .tango-actions
- .tango-btn-group
- .tango-button-badge
- .tango-button-icon
- .tango-form
- .tango-form-btn
- .tango-form-checkbox
- .tango-form-group
- .tango-link-badge
- .tango-link-icon
- .tango-thead
- .tango-tooltip-wrapper

Error
=====

When you get to see this :
![twig error][twig-error]
It means your json is invalid. Don't worry you probrably just missed a comma somewhere.

Bootstrap 3 toggles
===================

|      Title      |         Toggle         |                   Parameters                   |   Attributes  |                                             Link                                             |
|-----------------|------------------------|------------------------------------------------|---------------|----------------------------------------------------------------------------------------------|
| Button          | data-toggle="button"   |                                                |               | [buttons-single-toggle](https://getbootstrap.com/docs/3.3/javascript#buttons-single-toggle) |
| Buttons         | data-toggle="buttons"  |                                                |               | [buttons](https://getbootstrap.com/docs/3.3/javascript#buttons)                             |
| Collapse        | data-toggle="collapse" | data-target data-parent href                   |               | [collapse](https://getbootstrap.com/docs/3.3/javascript#collapse)                           |
| Dropdowns       | data-toggle="dropdown" |                                                |               | [dropdowns](https://getbootstrap.com/docs/3.3/javascript#dropdowns)                         |
| Modals          | data-toggle="modal"    | data-target="..."                              | rel="modal"   | [modals](https://getbootstrap.com/docs/3.3/javascript#modals)                               |
| Popovers        | data-toggle="popover"  | data-placement data-trigger data-content title | rel="popover" | [popovers](https://getbootstrap.com/docs/3.3/javascript#popovers)                           |
| Togglable pills | data-toggle="pill"     |                                                |               | [pills](https://getbootstrap.com/docs/3.3/javascript#pills)                                 |
| Togglable tabs  | data-toggle="tab"      |                                                |               | [tabs](https://getbootstrap.com/docs/3.3/javascript#tabs)                                   |
| Tooltips        | data-toggle="tooltip"  | data-original-title data-placement title       |               | [tooltips](https://getbootstrap.com/docs/3.3/javascript#tooltips)                           |

Note
====

If you find any bug please report here : [Issues](https://github.com/TangoMan75/FrontBundle/issues/new)

License
=======

Copyrights (c) 2017 Matthias Morin

[![License][license-MIT]][license-url]
Distributed under the MIT license.

If you like **TangoMan Front Bundle** please star!
And follow me on GitHub: [TangoMan75](https://github.com/TangoMan75)
... And check my other cool projects.

[Matthias Morin | LinkedIn](https://www.linkedin.com/in/morinmatthias)

[license-GPL]: https://img.shields.io/badge/Licence-GPLv3.0-green.svg
[license-MIT]: https://img.shields.io/badge/Licence-MIT-green.svg
[license-url]: LICENSE
[twig-error]: Resources/doc/error-invalid-json.jpg
