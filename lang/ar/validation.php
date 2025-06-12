<?php

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
$locales = array();
foreach (['ar','en'] as $l) {
    $locales[$l] = $l;
}

$attributes = [
    'language' => getTranslatedWords('language'),
    'name' => getTranslatedWords('name'),
    'email' => getTranslatedWords('email'),
    'password' => getTranslatedWords('password'),
    'title' => getTranslatedWords('title'),
    'phone' => getTranslatedWords('phone'),
    'image' => getTranslatedWords('image'),
    'logo' => getTranslatedWords('logo'),
  
    'roles' => getTranslatedWords('roles'),
   
    'product_id' => getTranslatedWords('product'),
    'product_id.*' => getTranslatedWords('product'),
    'balance' => getTranslatedWords('balance'),
    'notes' => getTranslatedWords('notes'),
    'address' => getTranslatedWords('address'),
    
    'date' => getTranslatedWords('date'),
    
    'description' => getTranslatedWords('description'),
    'description.*' => getTranslatedWords('description'),
    'value' => getTranslatedWords('value'),
    'gender' => getTranslatedWords('gender'),
    'system_name' => getTranslatedWords('system name'),
    
    'status' => getTranslatedWords('status'),
    'number' => getTranslatedWords('number'),
    
    'qty' => getTranslatedWords('quantity'),
    'qty.*' => getTranslatedWords('quantity'),
    'price' => getTranslatedWords('price'),
    'price.*' => getTranslatedWords('price'),
    'discount' => getTranslatedWords('discount'),
    'discount.*' => getTranslatedWords('discount'),
    'category_id' => getTranslatedWords('category'),
    'sub_category_id' => getTranslatedWords('sub category'),
   
    'permissions' => getTranslatedWords('permissions'),
    
    'payment_method' => getTranslatedWords('payment method'),
    
  
    'message' => getTranslatedWords('message'),
    //'notification' => getTranslatedWords('notification'),
    'customer_id' => getTranslatedWords('customer'),
    'customer_id.*' => getTranslatedWords('customer'),
    
    'parent_id' => getTranslatedWords('parent'),
    'city_id' => getTranslatedWords('city'),
    'code' => getTranslatedWords('verification code'),
    'product' => getTranslatedWords('product'),
    'rate' => getTranslatedWords('rate'),
    'old_password' => getTranslatedWords('old password'),
    'new_password' => getTranslatedWords('new password'),
    'products' => getTranslatedWords('products'),
    'products.*.id' => getTranslatedWords('product number'),
    'products.*.qty' => getTranslatedWords('product quantity'),
    'order' => getTranslatedWords('order'),
    'review' => getTranslatedWords('comment'),
    'area_id' => getTranslatedWords('area'),
    'problem' => getTranslatedWords('your problem or question'),
    'current_password'=>getTranslatedWords('current password')

];
foreach ($attributes as $key => $value) {
    foreach ($locales as $k => $v) {
        $attributes[$key . ':' . $k] = $value . ' ' . getTranslatedWords('in ' . $v);
    }
}

return [
    'accepted' => 'يجب قبول :attribute.',
    'accepted_if' => 'يجب قبول :attribute في حالة :other يساوي :value.',
    'active_url' => 'حقل :attribute لا يُمثّل رابطًا صحيحًا.',
    'after' => 'يجب على حقل :attribute أن يكون تاريخًا لاحقًا للتاريخ :date.',
    'after_or_equal' => 'حقل :attribute يجب أن يكون تاريخاً لاحقاً أو مطابقاً للتاريخ :date.',
    'alpha' => 'يجب أن لا يحتوي حقل :attribute سوى على حروف.',
    'alpha_dash' => 'يجب أن لا يحتوي حقل :attribute سوى على حروف، أرقام ومطّات.',
    'alpha_num' => 'يجب أن يحتوي حقل :attribute على حروفٍ وأرقامٍ فقط.',
    'array' => 'يجب أن يكون حقل :attribute ًمصفوفة.',
    'before' => 'يجب على حقل :attribute أن يكون تاريخًا سابقًا للتاريخ :date.',
    'before_or_equal' => 'حقل :attribute يجب أن يكون تاريخا سابقا أو مطابقا للتاريخ :date.',
    'between' => [
        'array' => 'يجب أن يحتوي حقل :attribute على عدد من العناصر بين :min و :max.',
        'file' => 'يجب أن يكون حجم ملف حقل :attribute بين :min و :max كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة حقل :attribute بين :min و :max.',
        'string' => 'يجب أن يكون عدد حروف نّص حقل :attribute بين :min و :max.',
    ],
    'boolean' => 'يجب أن تكون قيمة حقل :attribute إما true أو false .',
    'confirmed' => 'حقل التأكيد غير مُطابق للحقل :attribute.',
    'current_password' => 'كلمة المرور غير صحيحة.',
    'date' => 'حقل :attribute ليس تاريخًا صحيحًا.',
    'date_equals' => 'يجب أن يكون حقل :attribute مطابقاً للتاريخ :date.',
    'date_format' => 'لا يتوافق حقل :attribute مع الشكل :format.',
    'declined' => 'يجب رفض :attribute.',
    'declined_if' => 'يجب رفض :attribute عندما يكون :other بقيمة :value.',
    'different' => 'يجب أن يكون الحقلان :attribute و :other مُختلفين.',
    'digits' => 'يجب أن يحتوي حقل :attribute على :digits رقمًا/أرقام.',
    'digits_between' => 'يجب أن يحتوي حقل :attribute بين :min و :max رقمًا/أرقام .',
    'dimensions' => 'الحقل:attribute يحتوي على أبعاد صورة غير صالحة.',
    'distinct' => 'للحقل :attribute قيمة مُكرّرة.',
    'email' => 'يجب أن يكون حقل :attribute عنوان بريد إلكتروني صحيح البُنية.',
    'ends_with' => 'يجب أن ينتهي حقل :attribute بأحد القيم التالية: :values',
    'enum' => 'حقل :attribute المختار غير صالح.',
    'exists' => 'القيمة المحددة :attribute غير موجودة.',
    'file' => 'الحقل :attribute يجب أن يكون ملفا.',
    'filled' => 'حقل :attribute إجباري.',
    'gt' => [
        'array' => 'يجب أن يحتوي حقل :attribute على أكثر من :value عناصر/عنصر.',
        'file' => 'يجب أن يكون حجم ملف حقل :attribute أكبر من :value كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة حقل :attribute أكبر من :value.',
        'string' => 'يجب أن يكون طول نّص حقل :attribute أكثر من :value حروفٍ/حرفًا.',
    ],
    'gte' => [
        'array' => 'يجب أن يحتوي حقل :attribute على الأقل على :value عُنصرًا/عناصر.',
        'file' => 'يجب أن يكون حجم ملف حقل :attribute على الأقل :value كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة حقل :attribute مساوية أو أكبر من :value.',
        'string' => 'يجب أن يكون طول نص حقل :attribute على الأقل :value حروفٍ/حرفًا.',
    ],
    'image' => 'يجب أن يكون حقل :attribute صورةً.',
    'in' => 'حقل :attribute غير موجود.',
    'in_array' => 'حقل :attribute غير موجود في :other.',
    'integer' => 'يجب أن يكون حقل :attribute عددًا صحيحًا.',
    'ip' => 'يجب أن يكون حقل :attribute عنوان IP صحيحًا.',
    'ipv4' => 'يجب أن يكون حقل :attribute عنوان IPv4 صحيحًا.',
    'ipv6' => 'يجب أن يكون حقل :attribute عنوان IPv6 صحيحًا.',
    'json' => 'يجب أن يكون حقل :attribute نصًا من نوع JSON.',
    'lt' => [
        'array' => 'يجب أن يحتوي حقل :attribute على أقل من :value عناصر/عنصر.',
        'file' => 'يجب أن يكون حجم ملف حقل :attribute أصغر من :value كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة حقل :attribute أصغر من :value.',
        'string' => 'يجب أن يكون طول نّص حقل :attribute أقل من :value حروفٍ/حرفًا.',
    ],
    'lte' => [
        'array' => 'يجب أن لا يحتوي حقل :attribute على أكثر من :value عناصر/عنصر.',
        'file' => 'يجب أن لا يتجاوز حجم ملف حقل :attribute :value كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة حقل :attribute مساوية أو أصغر من :value.',
        'string' => 'يجب أن لا يتجاوز طول نّص حقل :attribute :value حروفٍ/حرفًا.',
    ],
    'mac_address' => 'الحقل :attribute يجب أن يكون عنوان MAC صالحاً.',
    'max' => [
        'array' => 'يجب أن لا يحتوي حقل :attribute على أكثر من :max عناصر/عنصر.',
        'file' => 'يجب أن لا يتجاوز حجم ملف حقل :attribute :max كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة حقل :attribute مساوية أو أصغر من :max.',
        'string' => 'يجب أن لا يتجاوز طول نّص حقل :attribute :max حروفٍ/حرفًا.',
    ],
    'mimes' => 'يجب أن يكون ملفًا من نوع : :values.',
    'mimetypes' => 'يجب أن يكون ملفًا من نوع : :values.',
    'min' => [
        'array' => 'يجب أن يحتوي حقل :attribute على الأقل على :min عُنصرًا/عناصر.',
        'file' => 'يجب أن يكون حجم ملف حقل :attribute على الأقل :min كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة حقل :attribute مساوية أو أكبر من :min.',
        'string' => 'يجب أن يكون طول نص حقل :attribute على الأقل :min حروفٍ/حرفًا.',
    ],
    'multiple_of' => 'حقل :attribute يجب أن يكون من مضاعفات :value',
    'not_in' => 'عنصر الحقل :attribute غير صحيح.',
    'not_regex' => 'صيغة حقل :attribute غير صحيحة.',
    'numeric' => 'يجب على حقل :attribute أن يكون رقمًا.',
    'password' => 'كلمة المرور غير صحيحة.',
    'present' => 'يجب تقديم حقل :attribute.',
    'prohibited' => 'حقل :attribute محظور.',
    'prohibited_if' => 'حقل :attribute محظور إذا كان :other هو :value.',
    'prohibited_unless' => 'حقل :attribute محظور ما لم يكن :other ضمن :values.',
    'prohibits' => 'الحقل :attribute يحظر تواجد الحقل :other.',
    'regex' => 'صيغة حقل :attribute .غير صحيحة.',
    'required' => 'حقل :attribute مطلوب.',
    'required_array_keys' => 'الحقل :attribute يجب أن يحتوي على مدخلات لـ: :values.',
    'required_if' => 'حقل :attribute مطلوب في حال ما إذا كان :other يساوي :value.',
    'required_unless' => 'حقل :attribute مطلوب في حال ما لم يكن :other يساوي :values.',
    'required_with' => 'حقل :attribute مطلوب إذا توفّر :values.',
    'required_with_all' => 'حقل :attribute مطلوب إذا توفّر :values.',
    'required_without' => 'حقل :attribute مطلوب إذا لم يتوفّر :values.',
    'required_without_all' => 'حقل :attribute مطلوب إذا لم يتوفّر :values.',
    'same' => 'يجب أن يتطابق حقل :attribute مع :other.',
    'size' => [
        'array' => 'يجب أن يحتوي حقل :attribute على :size عنصرٍ/عناصر بالضبط.',
        'file' => 'يجب أن يكون حجم ملف حقل :attribute :size كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة حقل :attribute مساوية لـ :size.',
        'string' => 'يجب أن يحتوي نص حقل :attribute على :size حروفٍ/حرفًا بالضبط.',
    ],
    'starts_with' => 'يجب أن يبدأ حقل :attribute بأحد القيم التالية: :values',
    'string' => 'يجب أن يكون حقل :attribute نصًا.',
    'timezone' => 'يجب أن يكون حقل :attribute نطاقًا زمنيًا صحيحًا.',
    'unique' => 'قيمة حقل :attribute مُستخدمة من قبل.',
    'uploaded' => 'فشل في تحميل الـ :attribute.',
    'url' => 'صيغة رابط حقل :attribute غير صحيحة.',
    'uuid' => 'حقل :attribute يجب أن يكون بصيغة UUID سليمة.',
    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],
    /*'values'=>[
        'from_requests' => getTranslatedWords('from requests'),
        'without_requests' => getTranslatedWords('without requests'),
    ],*/

    /*'values' => [
        'type' => [
            'from_requests' => getTranslatedWords('from requests'),
            'without_requests' => getTranslatedWords('without requests'),
            'related' => getTranslatedWords('related to list'),
            'not_related' => getTranslatedWords('not related to list'),
        ],
        'payment_method' => [
            'on_paids' => getTranslatedWords('on paids'),
            'cash' => getTranslatedWords('cash'),
            'by_check' => getTranslatedWords('by check'),
            'others' => getTranslatedWords('other payment method'),
            'check' => getTranslatedWords('by check'),
            'online' => getTranslatedWords('online'),
        ],
        'status' => [
            'inactive' => getTranslatedWords('inactive'),
            'active' => getTranslatedWords('active'),
            'refused' => getTranslatedWords('refused'),
            'stop_marketing' => getTranslatedWords('stop_marketing'),
            'delivered' => getTranslatedWords('delivered'),
        ],
        'category' => [
            'consultant' => getTranslatedWords('consultant'),
            'employee' => getTranslatedWords('employee'),
        ],
        'come_from' => [
            'consultant' => getTranslatedWords('customer'),
            'other_department' => getTranslatedWords('other department'),
        ]


    ],*/
    //'locales'=>$locales,
    'attributes' => $attributes
];
