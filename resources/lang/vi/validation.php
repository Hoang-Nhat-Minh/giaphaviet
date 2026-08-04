<?php

return [
  'required' => 'Vui lòng nhập :attribute',
  'email' => 'Email không hợp lệ',
  'max' => ':attribute không được quá :max ký tự.',
  'min' => ':attribute phải có ít nhất :min ký tự.',
  'unique' => ':attribute này đã được sử dụng.',
  'numeric' => ':attribute phải là một số.',
  'digits_between' => ':attribute phải có từ :min đến :max số.',
  'same' => ':attribute không trùng khớp với :other.',

  // Tùy chỉnh thông báo cho từng trường
  'attributes' => [
    'email' => 'Email',
    'name' => 'Tên',
    'phone' => 'Số điện thoại',
    'lineages' => 'Dòng họ',
    'branches' => 'Chi họ',
    'location' => 'Địa điểm',
    'password' => 'Mật khẩu',
    'rewrite' => 'Nhập lại mật khẩu',
  ],
];
