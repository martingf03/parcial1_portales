<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = "posts";

    protected $primaryKey = "id";

    protected $fillable = ['title', 'summary', 'content', 'image', 'image_description', 'publish_date', 'featured'];

        /**
         * Summary of getFormattedContentAttribute
         * Trae el contenido en la base de datos y detecta donde hay saltos de línea (\n), si existen, los corta y separa en distintas etiquetas <p>.
         * @return string
         */
        public function getFormattedContentAttribute(): string
    {
        $paragraphs = preg_split('/\r\n|\r|\n/', trim($this->content));
        $html = '';

        foreach ($paragraphs as $line) {
            if (trim($line) !== '') {
                $html .= '<p class="mb-4">' . e($line) . '</p>';
            }
        }

        return $html;
    }
}

