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
    'alpha' => 'The :attribute may only contain letters.',
    'alpha_dash' => 'The :attribute may only contain letters, numbers, and dashes.',
    'alpha_num' => 'The :attribute may only contain letters and numbers.',
    'array' => 'The :attribute must be an array.',
    'before' => 'The :attribute must be a date before :date.',
    'between' => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file' => 'The :attribute must be between :min and :max kilobytes.',
        'string' => 'The :attribute must be between :min and :max characters.',
        'array' => 'The :attribute must have between :min and :max items.',
    ],
    'boolean' => 'The :attribute field must be true or false.',
    'confirmed' => 'The :attribute confirmation does not match.',
    'date' => 'The :attribute is not a valid date.',
    'date_format' => 'The :attribute does not match the format :format.',
    'different' => 'The :attribute and :other must be different.',
    'digits' => 'The :attribute must be :digits digits.',
    'digits_between' => 'The :attribute must be between :min and :max digits.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'email' => 'The :attribute must be a valid email address.',
    'exists' => 'The selected :attribute is invalid.',
    'filled' => 'The :attribute field is required.',
    'image' => 'The :attribute must be an image.',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => 'The :attribute must be an integer.',
    'ip' => 'The :attribute must be a valid IP address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'max' => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file' => 'The :attribute may not be greater than :max kilobytes.',
        'string' => 'The :attribute may not be greater than :max characters.',
        'array' => 'The :attribute may not have more than :max items.',
    ],
    'mimes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => 'The :attribute must be at least :min.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => 'The :attribute must be at least :min characters.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'not_in' => 'The selected :attribute is invalid.',
    'numeric' => 'The :attribute must be a number.',
    'present' => 'The :attribute field must be present.',
    'regex' => 'The :attribute format is invalid.',
    'required' => 'The :attribute field is required.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values is present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'numeric' => 'The :attribute must be :size.',
        'file' => 'The :attribute must be :size kilobytes.',
        'string' => 'The :attribute must be :size characters.',
        'array' => 'The :attribute must contain :size items.',
    ],
    'string' => 'The :attribute must be a string.',
    'timezone' => 'The :attribute must be a valid zone.',
    'unique' => 'The :attribute has already been taken.',
    'url' => 'The :attribute format is invalid.',
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
        'email' => [
            'email' => 'Địa chỉ email chưa đúng định dạng.',
            'required' => 'Địa chỉ email là cần thiết.',
            'unique' => 'Địa chỉ email đã được đăng ký.'
        ],
        'password' => [
            'required' => 'Mật khẩu là cần thiết.',
            'min' => 'Mật khẩu phải có độ dài tối thiểu :min ký tự.',
            'confirmed' => 'Mật khẩu xác thực không khớp'
        ],
        'phone_number' => [
            'required' => 'Số điện thoại là cần thiết.',
            'min' => 'Số điện thoại phải có độ dài tối thiểu :min ký tự.',
            'max' => 'Số điện thoại phải có độ dài tối đa :max ký tự.',
            'unique' => 'Số điện thoại đã được đăng ký.'
        ],
        'username' => [
            'required' => 'Tên đăng nhập là cần thiết.',
            'min' => 'Tên đăng nhập phải có độ dài tối thiểu :min ký tự.',
            'max' => 'Tên đăng nhập phải có độ dài tối đa :max ký tự.',
            'unique' => 'Tên đăng nhập đã được đăng ký.'
        ],
        'shop_name' => [
            'required' => 'Tên cửa hàng là cần thiết.',
            'min' => 'Tên cửa hàng phải có độ dài tối thiểu :min ký tự.',
            'max' => 'Tên cửa hàng phải có độ dài tối đa :max ký tự.',
            'unique' => 'Tên cửa hàng đã được đăng ký.'
        ],
        'home_number' => [
            'required' => 'Địa chỉ nhà là cần thiết.',
            'min' => 'Địa chỉ nhà phải có độ dài tối thiểu :min ký tự.',
            'max' => 'Địa chỉ nhà phải có độ dài tối đa :max ký tự.',
            'unique' => 'Địa chỉ nhà đã được đăng ký.'
        ],
        'office_number' => [
            'required' => 'Địa chỉ cửa hàng là cần thiết.',
            'min' => 'Địa chỉ cửa hàng phải có độ dài tối thiểu :min ký tự.',
            'max' => 'Địa chỉ cửa hàng phải có độ dài tối đa :max ký tự.',
            'unique' => 'Địa chỉ cửa hàng đã được đăng ký.'
        ],
        'office_ward_id' => [
            'required' => 'Địa chỉ cửa hàng là cần thiết.',
            'min' => 'Địa chỉ cửa hàng phải có độ dài tối thiểu :min ký tự.',
            'max' => 'Địa chỉ cửa hàng phải có độ dài tối đa :max ký tự.',
            'unique' => 'Địa chỉ cửa hàng đã được đăng ký.'
        ],
        'office_district_id' => [
            'required' => 'Địa chỉ cửa hàng là cần thiết.',
            'min' => 'Địa chỉ cửa hàng phải có độ dài tối thiểu :min ký tự.',
            'max' => 'Địa chỉ cửa hàng phải có độ dài tối đa :max ký tự.',
            'unique' => 'Địa chỉ cửa hàng đã được đăng ký.'
        ],
        'office_city_id' => [
            'required' => 'Địa chỉ cửa hàng là cần thiết.',
            'min' => 'Địa chỉ cửa hàng phải có độ dài tối thiểu :min ký tự.',
            'max' => 'Địa chỉ cửa hàng phải có độ dài tối đa :max ký tự.',
            'unique' => 'Địa chỉ cửa hàng đã được đăng ký.'
        ],
        'identity_card' => [
            'required' => 'Chứng minh thư là cần thiết.',
            'min' => 'Chứng minh thư phải có độ dài tối thiểu :min ký tự.',
            'max' => 'Chứng minh thư phải có độ dài tối đa :max ký tự.',
            'unique' => 'Chứng minh thư đã được đăng ký.'
        ],
        'longitude' => [
            'required' => 'Kinh độ là cần thiết.',
            'min' => 'Kinh độ phải có độ dài tối thiểu :min ký tự.',
            'max' => 'Kinh độ phải có độ dài tối đa :max ký tự.',
            'unique' => 'Kinh độ đã được đăng ký.'
        ],
        'latitude' => [
            'required' => 'Vĩ độ là cần thiết.',
            'min' => 'Vĩ độ phải có độ dài tối thiểu :min ký tự.',
            'max' => 'Vĩ độ phải có độ dài tối đa :max ký tự.',
            'unique' => 'Vĩ độ đã được đăng ký.'
        ],
        'distance' => [
            'required' => 'Khoảng cách là cần thiết.',
            'min' => 'Khoảng cách phải có độ dài tối thiểu :min ký tự.',
            'max' => 'Khoảng cách phải có độ dài tối đa :max ký tự.',
            'unique' => 'Khoảng cách đã được đăng ký.'
        ],
    ],
    /*
      |--------------------------------------------------------------------------
      | Custom Validation Attributes
      |--------------------------------------------------------------------------
      |
      | The following language lines are used to swap attribute place-holders
      | with something more reader friendly such as E-Mail Address instead
      | of "email". This simply helps us make messages a little cleaner.
      |
     */
    'attributes' => [],
];
