 <?php
 /*
  * Building
  */
 Route::group(['prefix' => config('building.prefix.api'), 'middleware' => 'api'], function () {
     Route::resource('page', '\Metrique\Building\Http\Controllers\PageController');
     Route::resource('page.section', '\Metrique\Building\Http\Controllers\Page\SectionController');
     Route::resource('page.section.content', '\Metrique\Building\Http\Controllers\Page\ContentController');
     Route::resource('component', '\Metrique\Building\Http\Controllers\ComponentController');
     Route::resource('component.structure', '\Metrique\Building\Http\Controllers\Component\StructureController');
 });
