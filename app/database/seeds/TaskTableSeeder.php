<?php

class TaskTableSeeder extends Seeder {

	public function run()
	{
		DB::table('tasks')->delete();
		DB::unprepared("ALTER TABLE `tasks` AUTO_INCREMENT = 1;");

		for($i=1; $i <= 25; ++$i) {
			$completed = (rand(0,1));
			$completed_at = $completed ? DB::raw('NOW()') : null;

			Task::create([
				'text' => 'Task #'.$i,
				'completed' => $completed,
				'completed_at' => $completed_at
			]);
		}
	}
}