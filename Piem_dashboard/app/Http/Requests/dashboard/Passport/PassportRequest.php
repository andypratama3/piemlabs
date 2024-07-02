<?php

namespace App\Http\Requests\dashboard\Passport;

use Illuminate\Foundation\Http\FormRequest;

class PassportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function getProdukId()
    {
        return $this->produk_id;
    }

    public function getKtp()
    {
        return $this->ktp;
    }

    public function getKk()
    {
        return $this->kk;
    }

    public function getAktaKelahiran()
    {
        return $this->akta_kelahiran;
    }

    public function getIjazah()
    {
        return $this->ijazah;
    }

    public function getSuratKawin()
    {
        return $this->surat_kawin;
    }

    public function getPassport()
    {
        return $this->passport;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }
}
