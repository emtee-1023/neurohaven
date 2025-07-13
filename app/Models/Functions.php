<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Functions extends Model
{
    public static function getServices(): array
    {
        return [
            [
                "id" => 1,
                "icon" => "bi bi-search icon",
                "short_name" => "Assessment",
                "long_name" => "Comprehensive Assessment",
                "short_desc" => "Discover your strengths",
                "long_desc" => "We evaluate your academic profile, interests, and learning needs to create a strong foundation for your college journey.",
            ],
            [
                "id" => 2,
                "icon" => "bi bi-list-check icon",
                "short_name" => "Matching",
                "long_name" => "College & Program Matching",
                "short_desc" => "Find your best-fit college",
                "long_desc" => "Our advisors research and recommend colleges and programs that align with your goals and learning style.",
            ],
            [
                "id" => 3,
                "icon" => "bi bi-pencil-square icon",
                "short_name" => "Application Help",
                "long_name" => "Application & Essay Support",
                "short_desc" => "Get expert guidance",
                "long_desc" => "From application strategy to essay brainstorming and editing, we help you present your best self.",
            ],
            [
                "id" => 4,
                "icon" => "bi bi-people icon",
                "short_name" => "Transition Prep",
                "long_name" => "Transition Preparation",
                "short_desc" => "Prepare for college life",
                "long_desc" => "We offer resources and coaching to ensure you’re ready—academically, socially, and emotionally—for college life.",
            ],
        ];
    }

    public static function getTestimonials(): array
    {
        return [
            [
                "comment" => "NeuroHaven has helped me secure a spot in an ivy-league school",
                "image" => "assets/img/person/person-m-9.webp",
                "name" => "Mark Talamson",
                "role" => "Student",
            ],
        ];
    }
}
