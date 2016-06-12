class CreateFollowRefs < ActiveRecord::Migration
  def change
    create_table :follow_refs do |t|
      t.integer :user_id
      t.integer :follower_id
      t.datetime :created_at
    end

    add_index :follow_refs, [:user_id, :follower_id], :unique => true
    add_index :follow_refs, :follower_id
  end
end
