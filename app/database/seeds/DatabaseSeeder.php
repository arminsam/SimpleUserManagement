<?php

class DatabaseSeeder extends Seeder {

	/**
	 * @var array
     */
	protected $tables;

	/**
	 * @var array
     */
	protected $seeders;

    public function __construct()
    {
        $this->tables = ['users', 'roles', 'capabilities', 'capability_role', 'role_user', 'password_reminders'];

        $this->seeders = ['UsersTableSeeder', 'RolesTableSeeder',
                'CapabilitiesTableSeeder', 'CapabilityRoleTableSeeder', 'RoleUserTableSeeder'];
    }
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->cleanDatabase();

		foreach ($this->seeders as $seedClass)
		{
			$this->call($seedClass);
		}
	}

	/**
	 * clean out the database before start seeding
     */
	private function cleanDatabase()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0');

		foreach ($this->tables as $table)
		{
			DB::table($table)->truncate();
		}

		DB::statement('SET FOREIGN_KEY_CHECKS=1');
	}

}
