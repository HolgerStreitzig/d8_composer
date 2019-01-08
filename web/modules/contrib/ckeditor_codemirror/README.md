CONTENTS OF THIS FILE
---------------------

 * Introduction
 * Requirements
 * Installation
 * Configuration
 * Documentation
 * Maintainers

INTRODUCTION
------------

CKEditor CodeMirror module adds syntax highlighting for "Source View" in
CKEditor WYSIWYG editor using the CKEditor CodeMirror Plugin.

 * For a full description of the module, visit the project page:
   https://www.drupal.org/project/ckeditor_codemirror

 * To submit bug reports and feature suggestions, or to track changes:
   https://www.drupal.org/project/issues/ckeditor_codemirror?version=8.x

REQUIREMENTS
------------

 * [CKEditor-CodeMirror-Plugin library](https://github.com/w8tcha/CKEditor-CodeMirror-Plugin)

   This can be added by Composer by adding this item to the root composer.json 
   file under the "repositories" section.

    ```
    {
        "type": "package",
        "package": {
            "name": "w8tcha/ckeditor_codemirror",
            "type": "drupal-library",
            "version": "1.17.8",
            "dist": {
                "type": "zip",
                "url": "https://github.com/w8tcha/CKEditor-CodeMirror-Plugin/archive/untagged-f790a6bee2e01b538b13.zip"
            }
        }
    }
    ```
    
    Then simply run ```composer require w8tcha/ckeditor_codemirror``` as normal.

INSTALLATION
------------

 1. Download and install CKEditor CodeMirror module.
 2. Download and uncompress the latest CKEditor-CodeMirror-Plugin release to the
    `libraries` folder in Drupal's root (if a `libraries` folder does not exist
    there, create one).
 3. Rename the uncompressed folder "ckeditor_codemirror" such that the resulting
    path to CKEditor CodeMirror's `plugin.js` file is:
    `/libraries/ckeditor_codemirror/codemirror/plugin.js`.

CONFIGURATION
-------------

 1. Go to **Administration » Configuration » Content authoring » Text formats
    and editors** (admin/config/content/formats).
 2. Click *Configure* for any text format using CKEditor as the text editor.
 3. Under *CKEditor plugin settings*, click *CodeMirror* and check **Enable
    CodeMirror source view syntax highlighting**. Make sure that the current
    toolbar has the "Source" button. Adjust other settings as desired.
 4. Scroll down and click **Save configuration**.
 5. Go to node create/edit page, choose the text format with CodeMirror plugin.
    Press the "Source" button.

DOCUMENTATION
-------------

Additional documentation of CKEditor CodeMirror's features can be found at:

 * The project's documentation pages on drupal.org:
   https://www.drupal.org/docs/8/modules/ckeditor-codemirror

 * CKEditor CodeMirror's official website:
   https://w8tcha.github.io/CKEditor-CodeMirror-Plugin/

MAINTAINERS
-----------

Current maintainers:
 * Christopher Charbonenau Wells (wells) - https://www.drupal.org/u/wells
 * Plazik - https://www.drupal.org/u/plazik
