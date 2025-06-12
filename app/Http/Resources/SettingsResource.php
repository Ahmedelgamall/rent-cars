<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'system_name' => $this->system_name,
            'about_us' => $this->about_us_description,
            'privacy_policy' => $this->privacy,
            'terms' => $this->terms,
            'logo' => $this->logo_path,
            'email' => $this->email,
            'phone' => $this->phone,
            'facebook_link' => $this->facebook_link,
            'twitter_link' => $this->twitter_link,
            'instagram_link' => $this->instagram_link,
            'address' => $this->address
        ];
    }
}
