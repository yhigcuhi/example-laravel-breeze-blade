<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * シーズン利用 リクエスト
 */
abstract class SeasonRequest extends FormRequest
{
    /**
     * シーズンコード利用
     * @return string|null
     */
    public function getSeasonCode(): ?string
    {
        // リクエスト存在 => そちら
        if ($this->input('season_code')) return $this->input('season_code');
        // それ以外 => セッション
        return $this->session()->get('season_code');
    }
}
