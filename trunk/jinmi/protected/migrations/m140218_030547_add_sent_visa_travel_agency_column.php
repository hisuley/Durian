<?php

class m140218_030547_add_sent_visa_travel_agency_column extends CDbMigration
{
	public function up()
	{
        $this->addColumn('visa_order', 'sent_agency_source', 'int');
	}

	public function down()
	{
        $this->dropColumn('visa_order', 'sent_agency_source');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}