<?php
/**
 * Author: Theo Champion
 * Date: 09/12/2022
 * Time: 10:47
 */


namespace LesIgnobles\BaseApiLaravel\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class BaseApiRequest extends FormRequest
{
    public function rules(): array
    {
        return [];
    }
}
