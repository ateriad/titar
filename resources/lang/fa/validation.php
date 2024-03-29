<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'The :attribute must be accepted.',
    'active_url' => 'The :attribute is not a valid URL.',
    'after' => 'The :attribute must be a date after :date.',
    'after_or_equal' => 'The :attribute must be a date after or equal to :date.',
    'alpha' => 'The :attribute may only contain letters.',
    'alpha_dash' => 'The :attribute may only contain letters, numbers, dashes and underscores.',
    'alpha_num' => 'The :attribute may only contain letters and numbers.',
    'array' => 'The :attribute must be an array.',
    'before' => 'The :attribute must be a date before :date.',
    'before_or_equal' => 'The :attribute must be a date before or equal to :date.',
    'between' => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file' => 'The :attribute must be between :min and :max kilobytes.',
        'string' => 'The :attribute must be between :min and :max characters.',
        'array' => 'The :attribute must have between :min and :max items.',
    ],
    'boolean' => 'The :attribute field must be true or false.',
    'confirmed' => 'فیلد :attribute و بازنویسی آن یکسان نیستند.',
    'date' => 'The :attribute is not a valid date.',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format' => 'The :attribute does not match the format :format.',
    'different' => 'The :attribute and :other must be different.',
    'digits' => 'فیلد :attribute باید :digits رقم باشد.',
    'digits_between' => 'The :attribute must be between :min and :max digits.',
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'email' => 'فرمت فیلد :attribute نادرست است.',
    'ends_with' => 'The :attribute must end with one of the following: :values',
    'exists' => 'فیلد :attribute نادرست است.',
    'file' => 'The :attribute must be a file.',
    'filled' => 'The :attribute field must have a value.',
    'gt' => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'string' => 'The :attribute must be greater than :value characters.',
        'array' => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :attribute must be greater than or equal :value.',
        'file' => 'The :attribute must be greater than or equal :value kilobytes.',
        'string' => 'The :attribute must be greater than or equal :value characters.',
        'array' => 'The :attribute must have :value items or more.',
    ],
    'image' => 'The :attribute must be an image.',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => 'The :attribute must be an integer.',
    'ip' => 'The :attribute must be a valid IP address.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file' => 'The :attribute must be less than or equal :value kilobytes.',
        'string' => 'The :attribute must be less than or equal :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => 'فیلد :attribute نمی‌تواند از :max بیشتر باشد.',
        'file' => 'The :attribute may not be greater than :max kilobytes.',
        'string' => 'فیلد :attribute نمی‌تواند بیشتر از :max نویسه باشد.',
        'array' => 'The :attribute may not have more than :max items.',
    ],
    'mimes' => 'The :attribute must be a file of type: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => 'The :attribute must be at least :min.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => 'فیلد :attribute نمی‌تواند کمتر از :min نویسه باشد.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'The :attribute must be a number.',
    'password' => 'The password is incorrect.',
    'present' => 'The :attribute field must be present.',
    'regex' => 'The :attribute format is invalid.',
    'required' => 'فیلد :attribute خالی است.',
    'required_if' => 'فیلد :attribute الزامیست اگر :other مساوی با :value باشد.',
    'required_unless' => 'فیلد :attribute الزامیست.',
    'required_with' => 'فیلد :attribute الزامیست.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'فیلد :attribute الزامیست.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'numeric' => 'The :attribute must be :size.',
        'file' => 'The :attribute must be :size kilobytes.',
        'string' => 'The :attribute must be :size characters.',
        'array' => 'The :attribute must contain :size items.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values',
    'string' => 'The :attribute must be a string.',
    'timezone' => 'The :attribute must be a valid zone.',
    'unique' => 'این :attribute پیش از این ثبت شده است.',
    'uploaded' => 'The :attribute failed to upload.',
    'url' => 'فیلد :attribute باید یک آدرس اینترنتی معتبر باشد.',
    'uuid' => 'The :attribute must be a valid UUID.',
    'wrong_reference_id' => 'کد پیگیری نامعتبر است.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'first_name' => 'نام',
        'last_name' => 'نام خانوادگی',
        'cellphone' => 'شماره همراه',
        'email' => 'ایمیل',
        'password' => 'گذرواژه',
        'role' => 'نقش',
        'url' => 'آدرس اینترنتی',
        'thumbnail' => 'بندانگشتی',
        'category' => 'دسته',
        'title' => 'عنوان',
        'content' => 'محتوا',
        'type' => 'نوع',
        'button' => 'دکمه',
        'image' => 'تصویر',
        'link' => 'لینک',
        'description' => 'توصیحات',
        'otp' => 'کد ورود',
        'search' => 'جستجو',
        'year' => 'سال ساخت' ,
        'genre' => 'ژانر' ,
        'publisher' => 'ناشر' ,
        'parent_id' => 'دسته والد' ,
        'position' => 'جایگاه' ,
        'name' => 'نام' ,
        'status' => 'وضعیت' ,
        'token' => 'کد' ,
        'skippable' => 'قابلیت رد کردن تبلیغ' ,
        'length' => 'مدت زمان پخش' ,
        'advertisement_id' => 'شناسه تبلیغ' ,
        'video_id' => 'شناسه ویدئو' ,
        'user_id' => 'شناسه کاربر' ,
    ],


];
