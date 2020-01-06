# Myanmar-Townships

A laravel package to handle backend for searching myanmar townships data.
The package use [Myanmar-tools](https://github.com/google/myanmar-tools) and [Rabbit converter php version](https://github.com/Rabbit-Converter/Rabbit-PHP) to convert unicode to zawgyi.

#### Basic Uasage
You can easily search township or district or state by unicode by using the MyanmarTownship Facade.
```
    MyanmarTownship::searchTownships('အင်းစိန်');
    MyanmarTownship::searchDistricts('မြောက်ပိုင်း');
    MyanmarTownship::searchStates('ရှမ်း');
```
#### Installation
```
    composer require kaungmyat/myanmar-townships
```
If you want to support zawgyi search, you need to install [Myanmar-tools](https://github.com/google/myanmar-tools) and [Rabbit converter php version](https://github.com/Rabbit-Converter/Rabbit-PHP) as well.

After installation, prepare database.
```sh
    php artisan migrate
    php artisan db:seed --class='MyanmarTownships\Seeders\TownshipSeeder'
```

## Usage
### Searching
MyanmarTownship Facade is the entry point for searching and provides three methods:
 - searchTownships
 - searchDistricts
 - searchStates
 
Parameter for these methods can be either a string or options array.
| Key | options | Default Value |
| ------ | ------ |------ |
| q | String to search | |
| sort | id, name_mm, name_en |name_mm|
| order | asc, desc| asc |
| limit | integer | 10 |
|resource_result| true, false| false|

#### Customizing
By default, the library support only for unicode searching, if you want to customize this behaviour, publish the config file and change the value accordingly.
```
    php artisan vendor:publish --tag=myanmar-townships
```
 | Key | Feature | Default Value |
 | ------ | ------ |------ |
 | search_by_unicode | enable or disable searching by unicode | true |
 | search_by_zawgyi | enable or disable searching by zawgyi | false |
 | search_by_english | enable or disable searching by zawgyi | false |
 | resource_result | return response should be model or json | false |
 | font_converter | Font converter path | MyanmarTownships\App\Helpers\Contracts\FontConverter |
 
 #### Supporting Zawgyi font
 This library use  [Myanmar-tools](https://github.com/google/myanmar-tools) and [Rabbit converter php version](https://github.com/Rabbit-Converter/Rabbit-PHP) to convert unicode to zawgyi. If you want to support zawgyi font, you need to install those packages too.
 In case if you have already implemented font logic, you can skip that packages. Instead, you now need to implement FontHelper interface and provide full namespace in the config.
 
 ### Json response
 If you want to obtain json obj instead of model, you can provide 'resource_result' set to true either at run time or at the config file.
 
 ### Model relation
 For any model that needs to have a township, you can use HaveTownship Trait in the model.
 
