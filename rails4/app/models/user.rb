class User < ActiveRecord::Base
  include Clearance::User

  # users that follow given user
  has_and_belongs_to_many :followers,
    class_name: 'User',
    join_table: 'follow_refs',
    foreign_key: 'user_id',
    association_foreign_key: 'follower_id',
    uniq: true

  # users followed by given user
  has_and_belongs_to_many :followings,
    class_name: 'User',
    join_table: 'follow_refs',
    foreign_key: 'follower_id',
    association_foreign_key: 'user_id',
    uniq: true

  has_one :current_user_follow_ref,
    -> { where('follow_refs.follower_id = ?', User.current_user.id) },
    class_name: 'FollowRef'

  has_many :activities,
    foreign_key: 'to_user_id'

  def self.current_user
    Thread.current[:current_user]
  end

  def self.current_user=(usr)
    Thread.current[:current_user] = usr
  end

  def following?(user)
    FollowRef.where(user_id: user.id, follower_id: self[:id]).count > 0
  end
end
