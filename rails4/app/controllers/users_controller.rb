class UsersController < ApplicationController
  include Wisper::Publisher

  before_action :require_login

  # Show users
  def index
     @users = User.all.includes(:current_user_follow_ref)
  end

  # Show user
  def show
    @user = User
      .where(id: params[:id])
      .includes(:current_user_follow_ref)
      .includes(:followers)
      .includes(:activities)
      .first
  end

  # Follow the other user
  def follow
    if current_user.id == params[:id]
      return redirect_to :back, alert: 'You cannot follow yourself!'
    end

    user = User.find(params[:id])

    if current_user.following? user
      return redirect_to :back, alert: 'You\'re already following this user!'
    end

    user.followers << current_user
    user.save

    subscribe(ActivityListener.new)
    subscribe(EmailListener.new)
    broadcast(:user_followed, user.id, current_user.id)

    redirect_to :back, notice: ('You\'re now following %s!' % user.name)
  end

  # Unfollow the other user
  def unfollow
    user = User.find(params[:id])

    unless current_user.following? user
      return redirect_to :back, alert: 'You\'re NOT following this user!'
    end

    user.followers.delete(current_user)

    subscribe(ActivityListener.new)
    broadcast(:user_unfollowed, user.id, current_user.id)

    redirect_to :back, notice: ('You\'re not following %s anymore!' % user.name)
  end
end
