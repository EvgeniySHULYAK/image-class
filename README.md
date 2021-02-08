# PHP class for working with images

The class is designed to work with JPEG images, namely: inserting and adjusting text by parameters, inserting an image into an image, resizing and much more in the PHP 5.6+.

# Usage
First of all, you need to connect the class to your main script. After that we load the picture. The class constructor accepts both absolute references and relative references.

```php
include("src.php");
$img = new IMGcore("template.jpg");
```

Adding a text field to the picture. Accepts text, centering, size, font, color, field size, X, Y, line spacing when wrapping.
Warning! If the text is not displayed in the picture, then change the path to the font to the root relative path!

```php
$img->addText($name, "center", 15, "font.ttf", $img->getColor(0, 0, 0), 100, 10, 15, 50);
```

Insert another image into the image. A link to the inserted image and positions by X in Y is passed.

```php
$img->insertImage("avatar.jpg", 13, 30);
```

Resize the image. Accepts new width and height.

```php
$img->resize(100, 100);
```

Change only the width/height. Accepts the new width/height of the image.

```php
$img->resizeToWidth(100);
$img->resizeToHeight(100);
```

Get image width/height.
```php
$img->getWidth();
$img->getHeight();
```

Save the image. Accepts link to save and quality from 1 to 100.

```php
$img->saveImage("newimg.jpg", 100);
```

Display the image in the browser. It will be possible in the future to download / view the image from the link to the file where the code is located.

```php
$img->printImage();
```
# Links
* [Author's website](https://webmaster-shulyak.ru/)
* [Order work](https://www.fiverr.com/qugent/)
* [VK](https://vk.com/qugen)
* [Telegram](https://t.me/qugen)
* [Blog](https://t.me/webmaster_shulyak)
