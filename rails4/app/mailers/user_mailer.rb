class UserMailer < ApplicationMailer
  def new_follower(user_id, follower_id)
    @user = User::find(user_id)
    @follower = User::find(follower_id)

    mail(to: @user.email, subject: 'You have a new follower!')
  end
end
