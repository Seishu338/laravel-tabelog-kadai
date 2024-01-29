<?php

namespace App\Admin\Controllers;

use App\Models\restaurant;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Category;
use App\Models\Day;

class RestaurantController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Restaurant';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new restaurant());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('category.name', __('Category Name'));
        $grid->column('name', __('Name'));
        $grid->column('description', __('Description'))->style(' overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2; 
            ');
        $grid->column('starting_time', __('Starting time'))->display(function ($time) {
            return date("H:i", strtotime($time));
        });
        $grid->column('ending_time', __('Ending time'))->display(function ($time) {
            return date("H:i", strtotime($time));
        });
        $grid->column('price', __('Price'))->sortable();
        $grid->column('postal_code', __('Postal code'));
        $grid->column('address', __('Address'));
        $grid->column('phone', __('Phone'));
        $grid->column('average_score', __('Average score'))->sortable();
        $grid->column('image', __('Image'))->image();


        $grid->closing_days()->display(function ($closing_days) {

            $closing_days = array_map(function ($closing_day) {
                return "<span class='label label-success'>{$closing_day['name']}</span>";
            }, $closing_days);

            return join('&nbsp;', $closing_days);
        });

        $grid->column('created_at', __('Created at'))->sortable();
        $grid->column('updated_at', __('Updated at'))->sortable();

        $grid->filter(function ($filter) {
            $filter->like('name', '店舗名');
            $filter->like('description', '店舗説明');
            $filter->between('price', '金額');
            $filter->in('category_id', 'カテゴリー')->multipleSelect(Category::all()->pluck('name', 'id'));
        });


        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(restaurant::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('category.name', __('Category Name'));
        $show->field('name', __('Name'));
        $show->field('description', __('Description'));
        $show->field('starting_time', __('Starting time'));
        $show->field('ending_time', __('Ending time'))->date('H:i');
        $show->field('price', __('Price'));
        $show->field('postal_code', __('Postal code'));
        $show->field('address', __('Address'));
        $show->field('phone', __('Phone'));
        $show->field('average_score', __('Average score'));
        $show->field('image', __('Image'))->image();
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));


        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new restaurant());

        $form->select('category_id', __('Category Name'))->options(Category::all()->pluck('name', 'id'))->creationRules(['required'])
            ->updateRules(['required']);
        $form->text('name', __('Name'))->creationRules(['required'])
            ->updateRules(['required']);
        $form->textarea('description', __('Description'))->creationRules(['required'])
            ->updateRules(['required']);
        $form->time('starting_time', __('Starting time'))->default(date('H'))->creationRules(['required'])
            ->updateRules(['required']);
        $form->time('ending_time', __('Ending time'))->default(date('H'))->creationRules(['required'])
            ->updateRules(['required']);
        $form->number('price', __('Price'))->creationRules(['required'])
            ->updateRules(['required']);
        $form->text('postal_code', __('Postal code'))->creationRules(['required'])
            ->updateRules(['required']);
        $form->textarea('address', __('Address'))->creationRules(['required'])
            ->updateRules(['required']);
        $form->mobile('phone', __('Phone'))->creationRules(['required'])
            ->updateRules(['required']);
        $form->decimal('average_score', __('Average score'))->default(0.0);
        $form->multipleSelect('closing_days', __('Closing day'))->options(Day::all()->pluck('name', 'id'))->creationRules(['required'])
            ->updateRules(['required']);
        $form->image('image', __('Image'));

        return $form;
    }
}
