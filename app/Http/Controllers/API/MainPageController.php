<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\HeaderInfo;
use App\Models\HeroBlock;
use App\Models\TeamMember;
use App\Models\Project;
use App\Models\Event;
use App\Models\SubordinateStructure;
use App\Models\FooterInfo;
use Illuminate\Http\JsonResponse;

class MainPageController extends Controller
{
    public function __invoke(): JsonResponse
    {
        // Получаем данные из базы
        $header = HeaderInfo::first();
        $hero = HeroBlock::first();
        $team = TeamMember::where('is_active', true)->orderBy('order')->get();
        $projects = Project::where('is_active', true)->orderBy('order')->get();
        $events = Event::where('is_active', true)->orderBy('start_date')->get();
        $structures = SubordinateStructure::where('is_active', true)->orderBy('order')->get();
        $footer = FooterInfo::first();

        // Формируем ответ
        return response()->json([
            'header' => $header ? [
                'phone' => $header->phone,
                'email' => $header->email,
                'feedback_link' => $header->feedback_link,
            ] : null,

            'hero' => $hero ? [
                'main_title' => $hero->main_title,
                'bottom_title' => $hero->bottom_title,
                'background_image' => $hero->background_image ? url('storage/' . $hero->background_image) : null,
                'statistics' => [
                    ['value' => $hero->stat_1_value, 'label' => $hero->stat_1_label],
                    ['value' => $hero->stat_2_value, 'label' => $hero->stat_2_label],
                    ['value' => $hero->stat_3_value, 'label' => $hero->stat_3_label],
                ],
            ] : null,

            'team' => $team->map(fn($member) => [
                'name' => $member->name,
                'position' => $member->position,
                'photo' => $member->photo ? url('storage/' . $member->photo) : null,
            ]),

            'projects' => $projects->map(fn($project) => [
                'title' => $project->title,
                'description' => $project->description,
                'photo' => $project->photo ? url('storage/' . $project->photo) : null,
                'link' => $project->link,
                'link_text' => $project->link_text,
            ]),

            'events' => $events->map(fn($event) => [
                'title' => $event->title,
                'description' => $event->description,
                'photo' => $event->photo ? url('storage/' . $event->photo) : null,
                'start_date' => $event->start_date,
                'end_date' => $event->end_date,
                'type' => $event->type,
            ]),

            'subordinate_structures' => $structures->map(fn($structure) => [
                'title' => $structure->title,
                'description' => $structure->description,
                'photo' => $structure->photo ? url('storage/' . $structure->photo) : null,
                'link' => $structure->link,
                'link_text' => $structure->link_text,
            ]),

            'footer' => $footer ? [
                'email' => $footer->email,
                'address' => $footer->address,
                'privacy_policy_link' => $footer->privacy_policy_link,
                'newsletter_link' => $footer->newsletter_link,
            ] : null,
        ]);
    }
}