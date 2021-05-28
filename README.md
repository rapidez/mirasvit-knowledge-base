# Mirasvit Knowledge Base

## Requirements

You need to have the [Mirasvit Knowledge Base](https://mirasvit.com/magento-2-extensions/knowledge-base.html) module installed and configured within your Magento 2 installation.

## Installation

```
composer require rapidez/mirasvit-knowledge-base
```

After that go to the configured base url, default: `/knowledge-base`

## Views

If you need to change the views you can publish them with:
```
php artisan vendor:publish --provider="Rapidez\MirasvitKnowledgeBase\MirasvitKnowledgeBaseServiceProvider" --tag=views
```

## Note

The features listed below are for currently not implemented (yet) but feel free to build it and create a pull request.
- Comments
- Ratings
- Sidebar
- Search
- Tags

## License

GNU General Public License v3. Please see [License File](LICENSE) for more information.
