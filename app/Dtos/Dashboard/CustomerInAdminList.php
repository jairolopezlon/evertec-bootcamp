<?php

namespace App\Dtos\Dashboard;

class CustomerInAdminList
{
    public function __construct(
        public int $id,
        public string $name,
        public string $email,
        public int $is_enabled,
    ) {
    }
}
