class CreateActivities < ActiveRecord::Migration
  def change
    create_table :activities do |t|
      t.string :action
      t.integer :from_user_id
      t.integer :to_user_id
      t.datetime :created_at
    end
  end
end
