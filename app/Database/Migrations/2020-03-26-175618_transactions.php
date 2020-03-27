<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Transactions extends Migration
{
	public function up()
	{
		$this->db->enableForeignKeyChecks();
		$this->forge->addField([
			'trx_id'				=> [
				'type'           	=> 'BIGINT',
				'constraint'     	=> 20,
				'unsigned'       	=> TRUE,
				'auto_increment' 	=> TRUE
			],
			'product_id'			=> [
				'type'           	=> 'BIGINT',
				'constraint'     	=> 20,
				'unsigned'       	=> TRUE,
				'null'				=> TRUE
			],
			'trx_price'       		=> [
				'type'           	=> 'INT',
				'constraint'     	=> '11',
			],
			'trx_date'       		=> [
				'type'           	=> 'DATE'
			],
		]);
		$this->forge->addKey('trx_id', TRUE);
		$this->forge->addForeignKey('product_id','products','product_id','CASCADE','CASCADE');
		$this->forge->createTable('transactions');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
