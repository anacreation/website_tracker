<?php

use Anacreation\Organization\Entities\Organization;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $organizations = [
            [
                'label'    => 'HQ',
                'children' => [
                    [
                        'label'    => 'North America',
                        'children' => [
                            [
                                'label'    => 'Canada',
                                'children' => [
                                    [
                                        'label'    => 'Québec',
                                        'children' => [
                                            ['label' => 'Montreal'],
                                            ['label' => 'Québec City'],
                                        ],
                                    ],
                                ],
                            ],
                            [
                                'label'    => 'USA',
                                'children' => [
                                    [
                                        'label'    => 'California',
                                        'children' => [
                                            ['label' => 'Los Angeles'],
                                            ['label' => 'Sacremento'],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
        $this->createLoop($organizations);
    }

    private function createOrganization(array $data, Organization $org = null) {
        return $org ?
            $org->children()->create(['label' => $data['label']]):
            Organization::create(['label' => $data['label']]);
    }

    private function createLoop(array $organizations, Organization $parent = null) {
        foreach($organizations as $organization) {
            /** @var Organization $org */
            $org = $this->createOrganization($organization,
                                             $parent);

            if(isset($organization['children'])) {
                $this->createLoop($organization['children'],
                                  $org);
            }
        }
    }
}
