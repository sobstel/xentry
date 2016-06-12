class Activity < ActiveRecord::Base
  belongs_to :from_user,
    class_name: 'User',
    foreign_key: 'from_user_id'
end
