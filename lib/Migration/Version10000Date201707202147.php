<?php
/**
 * @copyright Copyright (c) 2018, Roeland Jago Douma <roeland@famdouma.nl>
 *
 * @author Roeland Jago Douma <roeland@famdouma.nl>
 *
 * @license GNU AGPL version 3 or any later version
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

namespace OCA\PrivateData\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Type;
use OCP\Migration\SimpleMigrationStep;
use OCP\Migration\IOutput;

class Version10000Date201707202147 extends SimpleMigrationStep {
	/**
	 * @param IOutput $output
	 * @param \Closure $schemaClosure The `\Closure` returns a `Schema`
	 * @param array $options
	 * @return null|Schema
	 * @since 13.0.0
	 */
	public function changeSchema(IOutput $output, \Closure $schemaClosure, array $options) {
		/** @var Schema $schema */
		$schema = $schemaClosure();

		if (!$schema->hasTable('privatedata')) {
			$table = $schema->createTable('privatedata');

			$table->addColumn('keyid',
				Type::INTEGER,
				[
					'notnull' => true,
					'length' => 4,
					'unsigned' => true,
					'autoincrement' => true,
				]
			);
			$table->addColumn('user',
				Type::STRING,
				[
					'notnull' => true,
					'length' => 64,
				]
			);
			$table->addColumn('app',
				Type::STRING,
				[
					'notnull' => true,
					'length' => 255,
				]
			);
			$table->addColumn('key',
				Type::STRING,
				[
					'notnull' => true,
					'length' => 255,
				]
			);
			$table->addColumn('value',
				Type::STRING,
				[
					'notnull' => true,
					'length' => 255,
				]
			);

			$table->setPrimaryKey(['keyid']);
		}

		return $schema;
	}
}
