                                                                                                                                                                                                                                                                                                                                            <?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminAuth;

use App\Http\Controllers\Admin\Admin_AuthController;
use App\Http\Controllers\Admin\Admin_DashboardController;
use App\Http\Controllers\Admin\Admin_CollegeController;
use App\Http\Controllers\Admin\Admin_DepartmentController;
use App\Http\Controllers\Admin\Admin_StaffController;
use App\Http\Controllers\Admin\Admin_DeanController;
use App\Http\Controllers\Admin\Admin_MinistryController;
use App\Http\Controllers\Admin\Admin_DocumentController;
use App\Http\Controllers\Admin\Admin_ProfileController;

use App\Http\Controllers\Admin\Admin_TrackerController;
use App\Http\Controllers\Admin\Admin_AnalyticsController;

use App\Http\Controllers\Admin\Admin_CellController;
use App\Http\Controllers\Admin\Admin_CellTypeController;
use App\Http\Controllers\Admin\Admin_CircleController;

use App\Http\Controllers\Admin\Admin_PermissionController;

// AcademicSessionController
use App\Http\Controllers\Admin\Admin_AcademicSessionController;

// SemesterController
use App\Http\Controllers\Admin\Admin_SemesterController;

//use CourseController
use App\Http\Controllers\Admin\Admin_CourseController;

// use RemunerationRateController
use App\Http\Controllers\Admin\Admin_RemunerationRateController;

use App\Http\Controllers\Admin\Admin_VenueTypeController;
use App\Http\Controllers\Admin\Admin_VenueCategoryController;
use App\Http\Controllers\Admin\Admin_VenueCategoryGroupController;

use App\Http\Controllers\Admin\Admin_VenueController;
use App\Http\Controllers\Admin\Admin_AnnouncementController;

use App\Http\Controllers\Admin\Admin_MeetingController;
use App\Http\Controllers\Admin\Admin_MeetingCommentController;
use App\Http\Controllers\Admin\Admin_PaperController;

use App\Http\Controllers\Admin\Admin_PaperCommentController;
use App\Http\Controllers\Admin\Admin_AgendaController;
use App\Http\Controllers\Admin\Admin_DigestController;
use App\Http\Controllers\Admin\Admin_MinuteController;
use App\Http\Controllers\Admin\Admin_AttendanceController;
use App\Http\Controllers\Admin\Admin_NotificationController;

use App\Http\Controllers\Admin\Admin_ElectionTypeController;

use App\Http\Controllers\Admin\Admin_ElectoralCommitteeController;
use App\Http\Controllers\Admin\Admin_ElectoralCommitteePositionController;
use App\Http\Controllers\Admin\Admin_ElectoralCommitteeMemberController;

use App\Http\Controllers\Admin\Admin_ElectionSuiteController;


use App\Http\Controllers\Admin\Admin_ElectionController;

use App\Http\Controllers\Admin\Admin_ElectionRegistrationController;
use App\Http\Controllers\Admin\Admin_PositionController;
use App\Http\Controllers\Admin\Admin_CandidateController;
use App\Http\Controllers\Admin\Admin_VoterRegistrationController;

use App\Http\Controllers\Admin\Admin_ResultController;



use App\Http\Controllers\Staff\Staff_AuthController;
use App\Http\Controllers\Staff\Staff_DashboardController;
use App\Http\Controllers\Staff\Staff_DocumentController;
use App\Http\Controllers\Staff\Staff_WorkflowController;
use App\Http\Controllers\Staff\Staff_GeneralMessageController;
use App\Http\Controllers\Staff\Staff_PrivateMessageController;

use App\Http\Controllers\Staff\Staff_ProfileController;

use App\Http\Controllers\Staff\Staff_CircleController;
use App\Http\Controllers\Staff\Staff_CircleGeneralRoomController;
use App\Http\Controllers\Staff\Staff_CircleTeamController;
use App\Http\Controllers\Staff\Staff_CircleAnnouncementController;




use App\Http\Controllers\Staff\Staff_CategoryController;
use App\Http\Controllers\Staff\Staff_MeetingController;

use App\Http\Controllers\Staff\Staff_PaperController;
use App\Http\Controllers\Staff\Staff_DigestController;
use App\Http\Controllers\Staff\Staff_MinuteController;
use App\Http\Controllers\Staff\Staff_AnnouncementController;

use App\Http\Controllers\Staff\Staff_MeetingCommentController;
use App\Http\Controllers\Staff\Staff_PaperCommentController;


use App\Http\Controllers\Student\Student_DashboardController;



use App\Http\Controllers\MailTestController;

use App\Http\Controllers\VotingCenterController;
use App\Http\Controllers\Student\Student_VoteController;

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Admin\Admin_HallController;
use App\Http\Controllers\Admin\Admin_HallResidentController;
use App\Http\Controllers\Admin\Admin_ResidentUploadController;

use App\Http\Controllers\RegistrationCenterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
class User
{
    public $name;
    public $email;
};

class Job
{
    public $title;
}

Route::get('test', function(){

    $user = (object) [
        'name' => 'Seyi Babs',
        'email' => 'babarindeos@funaab.edu.ng'
    ];

    $user = new User();
    $user->name = "Seyi Babs";
    $user->email = "babarindeos@funaab.edu.ng";


    //dd($user->email);

    /* $job = (object) [
        'title' => 'Laravel Developer'
    ]; */

    $job = new Job();
    $job->title = "Laravel Developer";

    //dd($job->title);

    

    \Illuminate\Support\Facades\Mail::to($user)->send(
        new \App\Mail\JobPosted($job)
    );

    return "Done";
});


Route::get('testmail', function(){
    $user = new User();
    $user->name = "Kondi Shiva";
    $user->email = "leakscrime@gmail.com";

    \Illuminate\Support\Facades\Mail::to($user)->send(
        new \App\Mail\SimpleMail()
    );

    return "Mail successfully sent";
});

Route::get('testmailcontroller', [MailTestController::class, 'dispatch']);

Route::get('testmailparams', [MailTestController::class, 'param_dispatch']);

Route::get('testmailbody', function(){
    $name = "Babarinde Oluwaseyi Abiodun";
    return new App\Mail\MarkupMail($name);

});

Route::get('queueMail', [MailTestController::class, 'QueueMailer']);



Route::get('/', [WelcomeController::class, 'index'])->name('welcome');


Route::get('/election_suites/{election_suite_uuid}/registration_center', [RegistrationCenterController::class, 'index'])->name('guest.registration_center.index');
Route::post('/election_suites/{election_suite_uuid}/registration_center', [RegistrationCenterController::class, 'login'])->name('guest.registration_center.login');
Route::get('/election_suite/{election_suite_uuid}/{matric_no}/{email}/registration_center', [RegistrationCenterController::class, 'registration_completed'])->name('guest.registration_center.completed');


Route::get('/voting_center', [VotingCenterController::class, 'index'])->name('guest.voting_center.index');
Route::post('/voting_center', [VotingCenterController::class, 'login'])->name('guest.voting_center.login');

Route::post('/', [Staff_AuthController::class, 'login'])->name('staff.auth.login');



Route::get('/admin', [Admin_AuthController::class, 'index'])->name('admin.auth.index');
Route::post('/admin', [Admin_AuthController::class, 'login'])->name('admin.auth.login');


Route::get('/{candidate_alias}', [WelcomeController::class, 'candidate_alias'])->name('guest.candidate.alias');



Route::get('elections/{election}/voting_completed', [Student_VoteController::class, 'voting_completed'])->name('student.elections.vote.voting_completed');



Route::prefix('student')->middleware(['auth', 'student'])->group(function(){
    Route::get('/dashboard', [Student_DashboardController::class, 'index'])->name('student.dashboard.index');
    
    // Voting
    Route::post('elections/start_voting', [Student_VoteController::class, 'start_voting'])->name('student.elections.start_voting');

    Route::get('/elections/vote', [Student_VoteController::class, 'vote'])->name('student.elections.vote');
    Route::post('/elections/vote', [Student_VoteController::class,  'cast_vote'])->name('student.elections.cast_vote');

    Route::post('/elections/previous', [Student_VoteController::class, 'previous'])->name('student.elections.vote.previous');
    Route::post('/elections/next', [Student_VoteController::class, 'next'])->name('student.elections.vote.next');
    Route::get('/elections/{election}/preview', [Student_VoteController::class, 'preview'])->name('student.elections.vote.preview');

    Route::post('/elections/finalize_voting', [Student_VoteController::class, 'finalize_voting'])->name('student.elections.vote.finalize_voting');


    Route::post('/logout', [Student_VoteController::class, 'logout'])->name('student.auth.logout');
    
    
});


Route::prefix('staff')->middleware(['auth', 'staff'])->group(function(){
    Route::get('/dashboard', [Staff_DashboardController::class, 'index'])->name('staff.dashboard.index');
    Route::post('/logout', [Staff_AuthController::class, 'logout'])->name('staff.auth.logout');


    // Circle
    Route::get('/circles', [Staff_CircleController::class, 'index'])->name('staff.circles.index');
    Route::get('/circles/{circle}/general_room', [Staff_CircleGeneralRoomController::class, 'general_room'])->name('staff.circles.general_room');
    Route::post('/circles/{cell}/general_room', [Staff_CircleGeneralRoomController::class, 'store'])->name('staff.circles.general_room.store');
    
    Route::get('/circles/{circle}/team', [Staff_CircleTeamController::class, 'team'])->name('staff.circles.team');

    Route::get('/circles/{circle}/announcements', [Staff_CircleAnnouncementController::class, 'announcements']
    )->name('staff.circles.announcements');

    Route::get('/circles/{circle}/create_announcement', [Staff_CircleAnnouncementController::class, 'create_announcement']
    )->name('staff.circles.create_announcement');

    Route::post('/circles/{circle}/store_announcement', [Staff_CircleAnnouncementController::class, 'store_announcement']
    )->name('staff.circles.store_announcement');

    Route::get('/circles/{circle}/announcement/{announcement}/show_announcement', [Staff_CircleAnnouncementController::class, 'show_announcement'])->name('staff.circles.show_announcement');
    Route::post('/circles/{circle}/announcement/{announcement}/store_announcement', [Staff_CircleAnnouncementController::class, 'store_announcement_comment'])->name('staff.circles.store_announcement_comment');

    // Documents
    Route::get('/documents', [Staff_DocumentController::class, 'index'])->name('staff.document.index');
    Route::get('/documents/create', [Staff_DocumentController::class, 'create'])->name('staff.documents.create');
    Route::post('/documents/store', [Staff_DocumentController::class, 'store'])->name('staff.documents.store');
    
    Route::get('/documents/{document}/show', [Staff_DocumentController::class, 'show'])->name('staff.documents.show');
    Route::get('/documents/mydocuments', [Staff_DocumentController::class, 'mydocuments'])->name('staff.documents.mydocuments');
    
    

    // Workflow
    Route::get('/workflows/{document}/flow', [Staff_WorkflowController::class, 'flow'])->name('staff.workflows.flow');
    Route::get('/workflows/{document}/add_contributor',[Staff_WorkflowController::class, 'add_contributor'])->name('staff.workflows.add_contributor');
    Route::post('/workflows/{document}/post_add_contributor', [Staff_WorkflowController::class, 'post_add_contributor'])->name('staff.workflows.post_add_contributor');

    Route::post('/workflows/{document}/search_staff', [Staff_WorkflowController::class, 'search_staff'])->name('staff.workflows.search_staff');
    Route::post('/workflows/{document}/forward_document', [Staff_WorkflowController::class, 'forward_document'])->name('staff.workflows.forward_document');

    Route::get('/workflows/{workflow}/notification_update', [Staff_WorkflowController::class, 'notification_update'])->name('staff.workflows.notification_update');

    
    Route::get('/workflows/{document}/general_message', [Staff_GeneralMessageController::class, 'index'])->name('staff.workflows.general_message');
    Route::post('/workflows/{document}/general_message', [Staff_GeneralMessageController::class, 'store'])->name('staff.workflows.general_message.store');

    Route::get('/workflows/{document}/private_messages/{recipient}/my_private_messages', [Staff_PrivateMessageController::class, 'my_private_messages'])->name('staff.workflows.private_messages.my_private_messages');
    Route::get('/workflows/{document}/private_message/{recipient}', [Staff_PrivateMessageController::class, 'index'])->name('staff.workflows.private_message.index');
    Route::get('/workflows/{document}/private_message/{sender}/{recipient}/{chat_uuid}/chat', [Staff_PrivateMessageController::class, 'chat'])->name('staff.workflows.private_message.chat');

    Route::post('/workflows/{document}/private_message/{sender}/{recipient}/{chat_uuid}/chat', [Staff_PrivateMessageController::class, 'store'])->name('staff.workflows.private_message.store');



    // Profile
    Route::get('/profile/create', [Staff_ProfileController::class, 'create'])->name('staff.profile.create');
    Route::post('/profile/create', [Staff_ProfileController::class, 'store'])->name('staff.profile.store');
    Route::post('/profile/upload_avatar', [Staff_ProfileController::class, 'upload_avatar'])->name('staff.profile.upload_avatar');

    Route::get('/profile/myprofile', [Staff_ProfileController::class, 'myprofile'])->name('staff.profile.myprofile');
    
    Route::get('/profile/myprofile/edit', [Staff_ProfileController::class, 'edit'])->name('staff.profile.myprofile.edit');
    Route::post('/profile/myprofile/update', [Staff_ProfileController::class, 'update'])->name('staff.profile.myprofile.update');

    Route::post('/profile/myprofile/update_avatar', [Staff_ProfileController::class, 'update_avatar'])->name('staff.profile.myprofile.update_avatar');
    
    Route::get('/profile/user/{fileno}', [Staff_ProfileController::class, 'user_profile'])->name('staff.profile.user_profile');
    Route::get('/profile/user/{email}/user_profile', [Staff_ProfileController::class, 'email_user_profile'])->name('staff.profile.email_user_profile');

    Route::get('/profile/change_password', [Staff_ProfileController::class, 'change_password'])->name('staff.profile.change_password');
    Route::post('/profile/update_password', [Staff_ProfileController::class, 'update_password'])->name('staff.profile.update_password');



    // Categories
    Route::get('/categories/create', [Staff_CategoryController::class, 'create'])->name('staff.categories.create');
    Route::post('/categories/store', [Staff_CategoryController::class, 'store'])->name('staff.categories.store');

    // Meeting
    Route::get('meetings', [Staff_MeetingController::class, 'index'])->name('staff.meetings.index');
    Route::get('meetings/{meeting}/show', [Staff_MeetingController::class, 'show'])->name('staff.meetings.show');
    Route::post('meetings/{meeting}/comments/store', [Staff_MeetingCommentController::class, 'store'])->name('staff.meetings.comments.store');
    Route::delete('meetings/{comment}/comments/delete', [Staff_MeetingCommentController::class, 'destroy'])->name('staff.meetings.comments.delete_comment');


    // Paper
    Route::get('papers', [Staff_PaperController::class, 'index'])->name('staff.papers.index');
    Route::get('papers/{paper}/show', [Staff_PaperController::class, 'show'])->name('staff.papers.show');
    Route::post('papers/{paper}/comments/store', [Staff_PaperCommentController::class, 'store'])->name('staff.papers.comments.store');
    Route::delete('papers/{comment}/comments/delete', [Admin_PaperCommentController::class, 'destroy'])->name('staff.meetings.papers.delete_comment');
    
    // Minutes
    Route::get('minutes', [Staff_MinuteController::class, 'index'])->name('staff.minutes.index');

    // Digests
    Route::get('digests', [Staff_DigestController::class, 'index'])->name('staff.digests.index');

    // Create Announcement
    Route::get('announcements', [Staff_AnnouncementController::class, 'index'])->name('staff.announcements.index');
    Route::get('announcements/{announcement}/show', [Staff_AnnouncementController::class, 'show'])->name('staff.announcements.show');

    Route::post('announcements/{announcement}/comments/store', [Staff_AnnouncementController::class, 'store_comment'])->name('staff.announcements.comments.store');
    Route::delete('announcements/{comment}/comments/delete', [Staff_AnnouncementController::class, 'delete_comment'])->name('staff.announcements.comments.delete_comment');

});



Route::prefix('admin')->middleware(['auth','admin'])->group(function(){
    
    Route::get('/dashboard', [Admin_DashboardController::class, 'index'])->name('admin.dashboard.index');
    Route::post('/logout', [Admin_AuthController::class, 'logout'])->name('admin.auth.logout');


    //Cell
    Route::get('/cells', [Admin_CellController::class, 'index'])->name('admin.cells.index');
    Route::get('cells/create', [Admin_CellController::class, 'create'])->name('admin.cells.create');
    Route::post('cells/store', [Admin_CellController::class, 'store'])->name('admin.cells.store');
    
    Route::get('cells/{cell}/edit', [Admin_CellController::class, 'edit'])->name('admin.cells.edit');
    Route::post('cells/{cell}/update', [Admin_CellController::class, 'update'])->name('admin.cells.update');

    Route::get('cells/{cell}/confirm_delete', [Admin_CellController::class, 'confirm_delete'])->name('admin.cells.confirm_delete');
    Route::post('cells/{cell}/destroy', [Admin_CellController::class, 'destroy'])->name('admin.cells.destroy');




    // Cell Type
    Route::get('/cell_types', [Admin_CellTypeController::class, 'index'])->name('admin.cell_types.index');
    Route::get('cell_types/create', [Admin_CellTypeController::class, 'create'])->name('admin.cell_types.create');
    Route::post('cell_types/store', [Admin_CellTypeController::class, 'store'])->name('admin.cell_types.store');
    
    Route::get('cell_types/{cell_type}/edit', [Admin_CellTypeController::class, 'edit'])->name('admin.cell_types.edit');
    Route::post('cell_types/{cell_type}/update', [Admin_CellTypeController::class, 'update'])->name('admin.cell_types.update');

    Route::get('cell_types/{cell_type}/confirm_delete', [Admin_CellTypeController::class, 'confirm_delete'])->name('admin.cell_types.confirm_delete');
    Route::post('cell_types/{cell_type}/destroy', [Admin_CellTypeController::class, 'destroy'])->name('admin.cell_types.destroy');

    
    // Circle    
    Route::get('circles/{cell}/show', [Admin_CircleController::class, 'show'])->name('admin.circles.show');
    Route::post('circles/{cell}/add_user', [Admin_CircleController::class, 'add_user'])->name('admin.circles.add_user');

    Route::get('circles/{cell}/user/{user}/permissions', [Admin_PermissionController::class, 'index'])->name('admin.circles.permissions');
    Route::post('circles/{cell}/user/{user}/permissions/create_announcement_set', [Admin_PermissionController::class, 'create_announcement_set'])->name('admin.circles.permissions.create_announcement_set');
    Route::post('circles/{cell}/user/{user}/permissions/create_announcement_on', [Admin_PermissionController::class, 'create_announcement_on'])->name('admin.circles.permissions.create_announcement_on');
    Route::post('circles/{cell}/user/{user}/permissions/create_announcement_off', [Admin_PermissionController::class, 'create_announcement_off'])->name('admin.circles.permissions.create_announcement_off');
    
    
    //college
    Route::get('/colleges', [Admin_CollegeController::class, 'index'])->name('admin.colleges.index');
    Route::get('/colleges/create', [Admin_CollegeController::class, 'create'])->name('admin.colleges.create');
    Route::post('colleges/store', [Admin_CollegeController::class, 'store'])->name('admin.colleges.store');
    Route::get('colleges/{college}/show', [Admin_CollegeController::class, 'show'])->name('admin.colleges.show');
    Route::get('colleges/{college}/edit', [Admin_CollegeController::class, 'edit'])->name('admin.colleges.edit');
    Route::post('colleges/{college}/update', [Admin_CollegeController::class, 'update'])->name('admin.colleges.update');
    Route::get('college/{college}/confirm_delete', [Admin_CollegeController::class, 'confirm_delete'])->name('admin.colleges.confirm_delete');
    Route::delete('college/{college}/delete', [Admin_CollegeController::class, 'destroy'])->name('admin.colleges.delete');




    // ministry
    Route::get('/ministries', [Admin_MinistryController::class, 'index'])->name('admin.ministries.index');
    Route::get('/ministries/create', [Admin_MinistryController::class, 'create'])->name('admin.ministries.create');
    Route::post('/ministries/store', [Admin_MinistryController::class, 'store'])->name('admin.ministries.store');
    
    Route::get('/ministries/{ministry}/show', [Admin_MinistryController::class, 'show'])->name('admin.ministries.show');
    Route::get('/ministries/{ministry}/edit', [Admin_MinistryController::class, 'edit'])->name('admin.ministries.edit');
    Route::post('/ministries/{ministry}/update', [Admin_MinistryController::class, 'update'])->name('admin.ministries.update');

    Route::get('/ministries/{ministry}/destroy', [Admin_MinistryController::class, 'destroy'])->name('admin.ministries.destroy');
    Route::post('/ministries/{ministry}/confirm_delete', [Admin_MinistryController::class, 'confirm_delete'])->name('admin.ministries.confirm_delete');

    

    // Department
    Route::get('/departments', [Admin_DepartmentController::class, 'index'])->name('admin.departments.index');
    Route::get('departments/create', [Admin_DepartmentController::class, 'create'])->name('admin.departments.create');
    Route::post('departments/store', [Admin_DepartmentController::class, 'store'])->name('admin.departments.store');
    Route::get('departments/{department}/show', [Admin_DepartmentController::class, 'show'])->name('admin.departments.show');
    
    Route::get('departments/{department}/edit', [Admin_DepartmentController::class, 'edit'])->name('admin.departments.edit');
    Route::post('departments/{department}/update', [Admin_DepartmentController::class, 'update'])->name('admin.departments.update');
    Route::get('departments/{department}/confirm_delete', [Admin_DepartmentController::class, 'confirm_delete'])->name('admin.departments.confirm_delete');
    Route::delete('departments/{department}/destroy', [Admin_DepartmentController::class, 'destroy'])->name('admin.departments.delete');
    Route::get('departments/get_departments_by_college', [Admin_DepartmentController::class, 'get_departments_by_college'])->name('admin.departments.get_departments_by_college');


    // Staff
    Route::get('staff', [Admin_StaffController::class, 'index'])->name('admin.staff.index');
    Route::get('staff/create', [Admin_StaffController::class, 'create'])->name('admin.staff.create');
    Route::post('staff/store', [Admin_StaffController::class, 'store'])->name('admin.staff.store');

    Route::get('staff/{staff}/edit', [Admin_StaffController::class, 'edit'])->name('admin.staff.edit');
    Route::post('staff/{staff}/update', [Admin_StaffController::class, 'update'])->name('admin.staff.update');

    // Document
    Route::get('documents', [Admin_DocumentController::class, 'index'])->name('admin.documents.index');
    Route::get('document_details/{document}', [Admin_DocumentController::class, 'show'])->name('admin.documents.show');

    // User Profile
    Route::get('/profile/user/{fileno}', [Admin_ProfileController::class, 'user_profile'])->name('admin.profile.user_profile');
    Route::get('/profile/user/{email}/user_profile', [Admin_ProfileController::class, 'email_user_profile'])->name('admin.profile.email_user_profile');

    // Tracker
    Route::get('tracker', [Admin_TrackerController::class, 'index'])->name('admin.tracker.index');
    Route::get('analytics', [Admin_AnalyticsController::class, 'index'])->name('admin.analytics.index');
    Route::post('tracker', [Admin_TrackerController::class, 'index'])->name('admin.tracker.index');


    // Deans
    Route::get('deans', [Admin_DeanController::class, 'index'])->name('admin.deans.index');
    Route::get('dean/create', [Admin_DeanController::class, 'create'])->name('admin.deans.create');
    Route::post('dean/get_assigned_dean', [Admin_DeanController::class, 'get_assigned_dean'])->name('admin.deans.get_assigned_dean');

    Route::get('dean/assign_dean', [Admin_DeanController::class, 'assign_dean'])->name('admin.deans.assign_dean');
    Route::post('dean/assign_dean', [Admin_DeanController::class, 'store_assign_dean'])->name('admin.deans.store_assign_dean');


    // Settings

    // Academic Sessions
    Route::get('academic_sessions', [Admin_AcademicSessionController::class, 'index'])->name('admin.academic_sessions.index');
    Route::get('academic_sessions/create', [Admin_AcademicSessionController::class, 'create'])->name('admin.academic_sessions.create');
    Route::post('academic_sessions/store', [Admin_AcademicSessionController::class, 'store'])->name('admin.academic_sessions.store');
    Route::get('academic_sessions/{academic_session}/edit', [Admin_AcademicSessionController::class, 'edit'])->name('admin.academic_sessions.edit');
    Route::post('academic_sessions/{academic_session}/update', [Admin_AcademicSessionController::class, 'update'])->name('admin.academic_sessions.update');
    Route::get('academic_sessions/{academic_session}/confirm_delete', [Admin_AcademicSessionController::class, 'confirm_delete'])->name('admin.academic_sessions.confirm_delete');
    Route::post('academic_sessions/{academic_session}/delete', [Admin_AcademicSessionController::class, 'destroy'])->name('admin.academic_sessions.destroy');
    Route::post('academic_sessions/{academic_session}/seton_current_session', [Admin_AcademicSessionController::class, 'seton_current_session'])->name('admin.academic_sessions.seton_current_session');
    Route::post('academic_sessions/{academic_session}/setoff_current_session', [Admin_AcademicSessionController::class, 'setoff_current_session'])->name('admin.academic_sessions.setoff_current_session');

    // Semesters
    Route::get('semesters', [Admin_SemesterController::class, 'index'])->name('admin.semesters.index');
    Route::get('semesters/create', [Admin_SemesterController::class, 'create'])->name('admin.semesters.create');
    Route::post('semesters/store', [Admin_SemesterController::class, 'store'])->name('admin.semesters.store');
    Route::get('semesters/{semester}/edit', [Admin_SemesterController::class, 'edit'])->name('admin.semesters.edit');
    Route::post('semesters/{semester}/update', [Admin_SemesterController::class, 'update'])->name('admin.semesters.update');
    Route::get('semesters/{semester}/confirm_delete', [Admin_SemesterController::class, 'confirm_delete'])->name('admin.semesters.confirm_delete');
    Route::post('semesters/{semester}/delete', [Admin_SemesterController::class, 'destroy'])->name('admin.semesters.delete');
    Route::post('semesters/{semester}/seton_current_semester', [Admin_SemesterController::class, 'seton_current_semester'])->name('admin.semesters.seton_current_semester');
    Route::post('semesters/{semester}/setoff_current_semester', [Admin_SemesterController::class, 'setoff_current_semester'])->name('admin.semesters.setoff_current_semester');

    // Courses
    Route::get('courses', [Admin_CourseController::class, 'index'])->name('admin.courses.index');
    Route::get('courses/create', [Admin_CourseController::class, 'create'])->name('admin.courses.create');
    Route::post('courses/store', [Admin_CourseController::class, 'store'])->name('admin.courses.store');
    Route::get('courses/{course}/show', [Admin_CourseController::class, 'show'])->name('admin.courses.show');
    Route::get('courses/{course}/edit', [Admin_CourseController::class, 'edit'])->name('admin.courses.edit');
    Route::post('courses/{course}/update', [Admin_CourseController::class, 'update'])->name('admin.courses.update');
    Route::get('courses/{course}/edit', [Admin_CourseController::class, 'edit'])->name('admin.courses.edit');
    Route::get('courses/{course}/confirm_delete', [Admin_CourseController::class, 'confirm_delete'])->name('admin.courses.confirm_delete');
    Route::post('courses/{course}/delete', [Admin_CourseController::class, 'destroy'])->name('admin.courses.delete');


    // Remuneration rates
    Route::get('remuneration_rates', [Admin_RemunerationRateController::class, 'index'])->name('admin.remuneration_rates.index');
    Route::get('remuneration_rates/create', [Admin_RemunerationRateController::class, 'create'])->name('admin.remuneration_rates.create');
    Route::post('remuneration_rates/store', [Admin_RemunerationRateController::class, 'store'])->name('admin.remuneration_rates.store');
    Route::get('remuneration_rates/{rate}/show', [Admin_RemunerationRateController::class, 'show'])->name('admin.remuneration_rates.show');
    Route::get('remuneration_rates/{rate}/edit', [Admin_RemunerationRateController::class, 'edit'])->name('admin.remuneration_rates.edit');
    Route::post('remuneration_rates/{rate}/update', [Admin_RemunerationRateController::class, 'update'])->name('admin.remuneration_rates.update');
    Route::get('remuneration_rates/{rate}/confirm_delete', [Admin_RemunerationRateController::class, 'confirm_delete'])->name('admin.remuneration_rates.confirm_delete');
    Route::post('remuneration_rates/{rate}/delete', [Admin_RemunerationRateController::class, 'destroy'])->name('admin.remuneration_rates.delete');



    // Venue Types
    Route::get('venue_types', [Admin_VenueTypeController::class, 'index'])->name('admin.venue_types.index');
    Route::get('venue_types/create', [Admin_VenueTypeController::class, 'create'])->name('admin.venue_types.create');
    Route::post('venue_types/store', [Admin_VenueTypeController::class, 'store'])->name('admin.venue_types.store');
    Route::get('venue_types/{venue_type}/edit', [Admin_VenueTypeController::class, 'edit'])->name('admin.venue_types.edit');
    Route::post('venue_types/{venue_type}/update', [Admin_VenueTypeController::class, 'update'])->name('admin.venue_types.update');
    Route::get('venue_types/{venue_type}/confirm_delete', [Admin_VenueTypeController::class, 'confirm_delete'])->name('admin.venue_types.confirm_delete');
    Route::delete('venue_types/{venue_type}/delete', [Admin_VenueTypeController::class, 'delete'])->name('admin.venue_types.delete');


    // Venue Category
    Route::get('venue_categories', [Admin_VenueCategoryController::class, 'index'])->name('admin.venue_categories.index');
    Route::get('venue_categories/create', [Admin_VenueCategoryController::class, 'create'])->name('admin.venue_categories.create');
    Route::post('venue_categories/store', [Admin_VenueCategoryController::class, 'store'])->name('admin.venue_categories.store');
    Route::get('venue_categories/{venue_category}/edit', [Admin_VenueCategoryController::class, 'edit'])->name('admin.venue_categories.edit');
    Route::post('venue_categories/{venue_category}/update', [Admin_VenueCategoryController::class, 'update'])->name('admin.venue_categories.update');
    Route::get('venue_categories/{venue_category}/confirm_delete', [Admin_VenueCategoryController::class, 'confirm_delete'])->name('admin.venue_categories.confirm_delete');
    Route::delete('venue_categories/{venue_category}/delete', [Admin_VenueCategoryController::class, 'delete'])->name('admin.venue_categories.delete');
    

    // Venue Category Group
    Route::get('venue_categories_group', [Admin_VenueCategoryGroupController::class, 'index'])->name('admin.venue_categories_group.index');
    Route::get('venue_categories_group/create', [Admin_VenueCategoryGroupController::class, 'create'])->name('admin.venue_categories_group.create');
    Route::post('venue_categories_group/store', [Admin_VenueCategoryGroupController::class, 'store'])->name('admin.venue_categories_group.store');
    Route::get('venue_categories_group/{group}/show', [Admin_VenueCategoryGroupController::class, 'show'])->name('admin.venue_categories_group.show');
    Route::get('venue_categories_group/{group}/edit', [Admin_VenueCategoryGroupController::class, 'edit'])->name('admin.venue_categories_group.edit');
    Route::post('venue_categories_group/{group}/update', [Admin_VenueCategoryGroupController::class, 'update'])->name('admin.venue_categories_group.update');
    Route::get('venue_categories_group/{group}/confirm_delete', [Admin_VenueCategoryGroupController::class, 'confirm_delete'])->name('admin.venue_categories_group.confirm_delete');
    Route::delete('venue_categories_group/{group}/delete', [Admin_VenueCategoryGroupController::class, 'delete'])->name('admin.venue_categories_group.delete');


    Route::get('venue_categories_group/{group}/add_category', [Admin_VenueCategoryGroupController::class, 'add_category'])->name('admin.venue_categories_group.add_category');
    Route::post('venue_categories_group/{group}/add_category', [Admin_VenueCategoryGroupController::class, 'store_category'])->name('admin.venue_categories_group.store_category');
    Route::post('venue_categories_group/{group_item}/remove_category', [Admin_VenueCategoryGroupController::class, 'remove_category'])->name('admin.venue_categories_group.remove_category');



    // Create Venue
    Route::get('venues', [Admin_VenueController::class, 'index'])->name('admin.venues.index');
    Route::get('venues/create', [Admin_VenueController::class, 'create'])->name('admin.venues.create');
    Route::post('venues/store', [Admin_VenueController::class, 'store'])->name('admin.venues.store');
    Route::get('venues/{venue}/edit', [Admin_VenueController::class, 'edit'])->name('admin.venues.edit');
    Route::post('venues/{venue}/update', [Admin_VenueController::class, 'update'])->name('admin.venues.update');
    Route::get('venues/{venue}/confirm_delete', [Admin_VenueController::class, 'confirm_delete'])->name('admin.venues.confirm_delete');
    Route::delete('venues/{venue}/delete', [Admin_VenueController::class, 'destroy'])->name('admin.venues.delete');


    // Create Announcement
    Route::get('announcements', [Admin_AnnouncementController::class, 'index'])->name('admin.announcements.index');
    Route::get('announcements/{announcement}/show', [Admin_AnnouncementController::class, 'show'])->name('admin.announcements.show');

    Route::get('announcements/create', [Admin_AnnouncementController::class, 'create']
    )->name('admin.announcements.create');

    Route::post('announcements/store', [Admin_AnnouncementController::class, 'store']
    )->name('admin.announcements.store');

    Route::post('announcements/{announcement}/comments/store', [Admin_AnnouncementController::class, 'store_comment'])->name('admin.announcements.comments.store');
    Route::delete('announcements/{comment}/comments/delete', [Admin_AnnouncementController::class, 'delete_comment'])->name('admin.announcements.comments.delete_comment');
    
    Route::get('announcements/{announcement}/notify', [Admin_AnnouncementController::class, 'notify'])->name('admin.announcements.notify');
    Route::post('announcements/{announcement}/notify', [Admin_AnnouncementController::class, 'post_notify'])->name('admin.announcements.post_notify');

    Route::get('announcements/{announcement}/edit', [Admin_AnnouncementController::class, 'edit'])->name('admin.announcements.edit');
    Route::post('announcements/{announcement}/update', [Admin_AnnouncementController::class, 'update'])->name('admin.announcements.update');

    Route::get('announcements/{announcement}/confirm_delete', [Admin_AnnouncementController::class, 'confirm_delete'])->name('admin.announcements.confirm_delete');
    Route::delete('announcements/{announcement}/delete', [Admin_AnnouncementController::class, 'destroy'])->name('admin.announcements.delete');

    Route::get('announcements/{announcement}/delete_file', [Admin_AnnouncementController::class, 'delete_file'])->name('admin.announcements.delete_file');


    // Meeting
    Route::get('meetings', [Admin_MeetingController::class, 'index'])->name('admin.meetings.index');
    Route::get('meetings/create', [Admin_MeetingController::class, 'create'])->name('admin.meetings.create');
    Route::post('meetings/store', [Admin_MeetingController::class, 'store'])->name('admin.meetings.store');
    Route::get('meetings/{meeting}/show', [Admin_MeetingController::class, 'show'])->name('admin.meetings.show');
    Route::get('meetings/{meeting}/edit', [Admin_MeetingController::class, 'edit'])->name('admin.meetings.edit');
    Route::post('meetings/{meeting}/update', [Admin_MeetingController::class, 'update'])->name('admin.meetings.update');
    Route::get('meetings/{meeting}/confirm_delete', [Admin_MeetingController::class, 'confirm_delete'])->name('admin.meetings.confirm_delete');
    Route::delete('meetings/{meeting}/delete', [Admin_MeetingController::class, 'destroy'])->name('admin.meetings.delete');
    
    Route::post('meetings/{meeting}/comments/store', [Admin_MeetingCommentController::class, 'store'])->name('admin.meetings.comments.store');
    Route::delete('meetings/{comment}/comments/delete', [Admin_MeetingCommentController::class, 'destroy'])->name('admin.meetings.comments.delete_comment');


    // Papers
    Route::get('papers', [Admin_PaperController::class, 'index'])->name('admin.papers.index');
    Route::get('papers/create', [Admin_PaperController::class, 'create'])->name('admin.papers.create');
    Route::post('papers/store', [Admin_PaperController::class, 'store'])->name('admin.papers.store');
    Route::get('papers/{paper}/show', [Admin_PaperController::class, 'show'])->name('admin.papers.show');
    Route::get('papers/{paper}/edit', [Admin_PaperController::class, 'edit'])->name('admin.papers.edit');
    Route::post('papers/{paper}/update', [Admin_PaperController::class, 'update'])->name('admin.papers.update');
    Route::get('papers/{paper}/confirm_delete', [Admin_PaperController::class, 'confirm_delete'])->name('admin.papers.confirm_delete');
    Route::delete('papers/{paper}/delete', [Admin_PaperController::class, 'destroy'])->name('admin.papers.delete');

    Route::get('papers/{paper}/set_status', [Admin_PaperController::class, 'set_status'])->name('admin.papers.set_status');
    Route::post('papers/{paper}/set_status', [Admin_PaperController::class, 'update_status'])->name('admin.papers.update_status');

    Route::post('papers/{paper}/comments/store', [Admin_PaperCommentController::class, 'store'])->name('admin.papers.comments.store');
    Route::delete('papers/{comment}/comments/delete', [Admin_PaperCommentController::class, 'destroy'])->name('admin.meetings.papers.delete_comment');


    // Agenda
    Route::get('meetings/{meeting}/agenda', [Admin_AgendaController::class, 'index'])->name('admin.meetings.agenda');
    Route::post('meetings/{meeting}/agenda/store', [Admin_AgendaController::class, 'store'])->name('admin.meetings.agenda.store');
    Route::delete('meetings/{agenda}/agenda/delete',[Admin_AgendaController::class, 'delete'])->name('admin.meetings.agenda.delete');


    // Digests
    Route::get('digests', [Admin_DigestController::class, 'index'])->name('admin.digests.index');
    Route::get('digests/create', [Admin_DigestController::class, 'create'])->name('admin.digests.create');
    Route::post('digests/store', [Admin_DigestController::class, 'store'])->name('admin.digests.store');
    Route::get('digests/{digest}/edit', [Admin_DigestController::class, 'edit'])->name('admin.digests.edit');
    Route::post('digests/{digest}/update', [Admin_DigestController::class, 'update'])->name('admin.digests.update');
    Route::get('digests/{digest}/confirm_delete', [Admin_DigestController::class, 'confirm_delete'])->name('admin.digests.confirm_delete');
    Route::delete('digests/{digest}/delete', [Admin_DigestController::class, 'destroy'])->name('admin.digests.delete');


    // Minutes
    Route::get('minutes', [Admin_MinuteController::class, 'index'])->name('admin.minutes.index');
    Route::get('minutes/create', [Admin_MinuteController::class, 'create'])->name('admin.minutes.create');
    Route::post('minutes/store', [Admin_MinuteController::class, 'store'])->name('admin.minutes.store');
    Route::get('minutes/{minute}/edit', [Admin_MinuteController::class, 'edit'])->name('admin.minutes.edit');
    Route::post('minutes/{minute}/update', [Admin_MinuteController::class, 'update'])->name('admin.minutes.update');
    Route::get('minutes/{minute}/confirm_delete', [Admin_MinuteController::class, 'confirm_delete'])->name('admin.minutes.confirm_delete');
    Route::delete('minutes/{minute}/delete', [Admin_MinuteController::class, 'destroy'])->name('admin.minutes.delete');


    Route::get('attendance/{meeting}/register', [Admin_AttendanceController::class, 'register'])->name('admin.attendance.register');
    Route::post('attendance/{meeting}/store', [Admin_AttendanceController::class, 'store'])->name('admin.attendance.store');
    Route::post('attendance/{attendance}/remove', [Admin_AttendanceController::class, 'remove'])->name('admin.attendance.store');


    Route::get('notifications', [Admin_NotificationController::class, 'index'])->name('admin.notifications.index');
    Route::get('notifications/create', [Admin_NotificationController::class, 'create'])->name('admin.notifications.create');
    Route::post('notifications/send', [Admin_NotificationController::class, 'send'])->name('admin.notifications.send');
    Route::get('notifications/send-completed', [Admin_NotificationController::class, 'send_completed'])->name('admin.notifications.send_completed');


    // ELection Types
    Route::get('election_types', [Admin_ElectionTypeController::class, 'index'])->name('admin.election_types.index');
    Route::get('election_types/create', [Admin_ElectionTypeController::class, 'create'])->name('admin.election_types.create');
    Route::post('election_types/store', [Admin_ElectionTypeController::class, 'store'])->name('admin.election_types.store');
    Route::get('election_types/{election_type}/edit', [Admin_ElectionTypeController::class, 'edit'])->name('admin.election_types.edit');
    Route::post('election_types/{election_type}/update', [Admin_ElectionTypeController::class, 'update'])->name('admin.election_types.update');
    Route::get('election_types/{election_type}/confirm_delete', [Admin_ElectionTypeController::class, 'confirm_delete'])->name('admin.election_types.confirm_delete');
    Route::delete('election_types/{election_type}/delete', [Admin_ElectionTypeController::class, 'destroy'])->name('admin.election_types.delete');



    // Electoral Committee
    Route::get('electoral_committees', [Admin_ElectoralCommitteeController::class, 'index'])->name('admin.electoral_committees.index');
    Route::get('electoral_committees/create',  [Admin_ElectoralCommitteeController::class, 'create'])->name('admin.electoral_committees.create');
    Route::post('electoral_committees/store', [Admin_ElectoralCommitteeController::class, 'store'])->name('admin.electoral_committees.store');
    Route::get('electoral_committees/{electoral_committee}/show', [Admin_ElectoralCommitteeController::class, 'show'])->name('admin.electoral_committees.show');
    Route::get('electoral_committees/{electoral_committee}/edit', [Admin_ElectoralCommitteeController::class, 'edit'])->name('admin.electoral_committees.edit');
    Route::post('electoral_committees/{electoral_committee}/update', [Admin_ElectoralCommitteeController::class, 'update'])->name('admin.electoral_committees.update');
    Route::get('electoral_committees/{electoral_committee}/confirm_delete', [Admin_ElectoralCommitteeController::class, 'confirm_delete'])->name('admin.electoral_committees.confirm_delete');
    Route::delete('electoral_committees/{electoral_committee}/delete', [Admin_ElectoralCommitteeController::class, 'destroy'])->name('admin.electoral_committees.delete');


    // Electoral Committee Position
    Route::get('electoral_committees/positions', [Admin_ElectoralCommitteePositionController::class, 'index'])->name('admin.electoral_committees.positions.index');
    Route::get('electoral_committees/positions/create',  [Admin_ElectoralCommitteePositionController::class, 'create'])->name('admin.electoral_committees.positions.create');
    Route::post('electoral_committees/positions/store', [Admin_ElectoralCommitteePositionController::class, 'store'])->name('admin.electoral_committees.positions.store');
    Route::get('electoral_committees/positions/{position}/show', [Admin_ElectoralCommitteePositionController::class, 'show'])->name('admin.electoral_committees.positions.show');
    Route::get('electoral_committees/positions/{position}/edit', [Admin_ElectoralCommitteePositionController::class, 'edit'])->name('admin.electoral_committees.positions.edit');
    Route::post('electoral_committees/positions/{position}/update', [Admin_ElectoralCommitteePositionController::class, 'update'])->name('admin.electoral_committees.positions.update');
    Route::get('electoral_committees/positions/{position}/confirm_delete', [Admin_ElectoralCommitteePositionController::class, 'confirm_delete'])->name('admin.electoral_committees.positions.confirm_delete');
    Route::delete('electoral_committees/positions/{position}/delete', [Admin_ElectoralCommitteePositionController::class, 'destroy'])->name('admin.electoral_committees.positions.delete');



    // Electoral Committee Members
    Route::get('electoral_committees/members', [Admin_ElectoralCommitteeMemberController::class, 'index'])->name('admin.electoral_committees.members.index');
    Route::get('electoral_committees/members/{electoral_committee}/create',  [Admin_ElectoralCommitteeMemberController::class, 'create'])->name('admin.electoral_committees.members.create');
    Route::post('electoral_committees/members/{electoral_committee}/store', [Admin_ElectoralCommitteeMemberController::class, 'store'])->name('admin.electoral_committees.members.store');
    Route::get('electoral_committees/members/{member}/show', [Admin_ElectoralCommitteeMemberController::class, 'show'])->name('admin.electoral_committees.members.show');
    Route::get('electoral_committees/members/{member}/edit', [Admin_ElectoralCommitteeMemberController::class, 'edit'])->name('admin.electoral_committees.members.edit');
    Route::post('electoral_committees/members/{member}/update', [Admin_ElectoralCommitteeMemberController::class, 'update'])->name('admin.electoral_committees.members.update');
    Route::get('electoral_committees/members/{member}/confirm_delete', [Admin_ElectoralCommitteeMemberController::class, 'confirm_delete'])->name('admin.electoral_committees.members.confirm_delete');
    Route::delete('electoral_committees/members/{member}/delete', [Admin_ElectoralCommitteeMemberController::class, 'destroy'])->name('admin.electoral_committees.members.delete');



    // Election Suite
    Route::get('election_suites', [Admin_ElectionSuiteController::class, 'index'])->name('admin.election_suites.index');
    Route::get('election_suites/create', [Admin_ElectionSuiteController::class, 'create'])->name('admin.election_suites.create');
    Route::post('election_suites/store', [Admin_ElectionSuiteController::class, 'store'])->name('admin.election_suites.store');
    Route::get('election_suites/{election_suite}/show', [Admin_ElectionSuiteController::class, 'show'])->name('admin.election_suites.show');
    Route::get('election_suites/{election_suite}/edit', [Admin_ElectionSuiteController::class, 'edit'])->name('admin.election_suites.edit');
    Route::post('election_suites/{election_suite}/update', [Admin_ElectionSuiteController::class, 'update'])->name('admin.election_suites.update');
    Route::get('election_suites/{election_suite}/confirm_delete', [Admin_ElectionSuiteController::class, 'confirm_delete'])->name('admin.election_suites.confirm_delete');
    Route::delete('election_suites/{election_suite}/delete', [Admin_ElectionSuiteController::class, 'destroy'])->name('admin.election_suites.delete');


    Route::get('election_suites/{election_suite}/registered_voters', [Admin_ElectionSuiteController::class, 'registered_voters'])->name('admin.election_suites.registered_voters');


    // Elections
    Route::get('elections', [Admin_ElectionController::class, 'index'])->name('admin.elections.index');
    Route::get('elections/create', [Admin_ElectionController::class, 'create'])->name('admin.elections.create');
    Route::post('elections/store', [Admin_ElectionController::class, 'store'])->name('admin.elections.store');
    Route::get('elections/{election}/show', [Admin_ElectionController::class, 'show'])->name('admin.elections.show');
    Route::get('elections/{election}/edit', [Admin_ElectionController::class, 'edit'])->name('admin.elections.edit');
    Route::post('elections/{election}/update', [Admin_ElectionController::class, 'update'])->name('admin.elections.update');
    Route::get('elections/{election}/confirm_delete', [Admin_ElectionController::class, 'confirm_delete'])->name('admin.elections.confirm_delete');
    Route::delete('elections/{election}/delete', [Admin_ElectionController::class, 'destroy'])->name('admin.elections.delete');


    // Election Registrations
    Route::get('election_registrations', [Admin_ElectionRegistrationController::class, 'index'])->name('admin.election_registrations.index');
    Route::get('election_registrations/create', [Admin_ElectionRegistrationController::class, 'create'])->name('admin.election_registrations.create');
    Route::post('election_registrations/store', [Admin_ElectionRegistrationController::class, 'store'])->name('admin.election_registrations.store');
    Route::get('election_registrations/{election_registration}/show', [Admin_ElectionRegistrationController::class, 'show'])->name('admin.election_registrations.show');
    Route::get('election_registrations/{election_registration}/edit', [Admin_ElectionRegistrationController::class, 'edit'])->name('admin.election_registrations.edit');
    Route::post('election_registrations/{election_registration}/update', [Admin_ElectionRegistrationController::class, 'update'])->name('admin.election_registrations.update');
    Route::get('election_registrations/{election_registration}/confirm_delete', [Admin_ElectionRegistrationController::class, 'confirm_delete'])->name('admin.election_registrations.confirm_delete');
    Route::delete('election_registrations/{election_registration}/delete', [Admin_ElectionRegistrationController::class, 'destroy'])->name('admin.election_registrations.delete');



    // Positions
    Route::get('positions', [Admin_PositionController::class, 'index'])->name('admin.positions.index');
    Route::get('positions/create', [Admin_PositionController::class, 'create'])->name('admin.positions.create');
    Route::post('positions/store', [Admin_PositionController::class, 'store'])->name('admin.positions.store');
    Route::get('positions/{position}/show', [Admin_PositionController::class, 'show'])->name('admin.positions.show');
    Route::get('positions/{position}/edit', [Admin_PositionController::class, 'edit'])->name('admin.positions.edit');
    Route::post('positions/{position}/update', [Admin_PositionController::class, 'update'])->name('admin.positions.update');
    Route::get('positions/{position}/confirm_delete', [Admin_PositionController::class, 'confirm_delete'])->name('admin.positions.confirm_delete');
    Route::delete('positions/{position}/delete', [Admin_PositionController::class, 'destroy'])->name('admin.positions.delete');


    // Candidates
    Route::get('elections/{election}/candidates', [Admin_CandidateController::class, 'index'])->name('admin.elections.candidates.index');
    Route::get('elections/{election}/candidates/create', [Admin_CandidateController::class, 'create'])->name('admin.elections.candidates.create');
    Route::post('elections/{election}/candidates/store', [Admin_CandidateController::class, 'store'])->name('admin.elections.candidates.store');
    Route::get('elections/candidates/{candidate}/show', [Admin_CandidateController::class, 'show'])->name('admin.elections.candidates.show');
    Route::get('elections/candidates/{candidate}/edit', [Admin_CandidateController::class, 'edit'])->name('admin.elections.candidates.edit');
    Route::post('elections/candidates/{candidate}/update', [Admin_CandidateController::class, 'update'])->name('admin.elections.candidates.update');
    Route::get('elections/candidates/{candidate}/confirm_delete', [Admin_CandidateController::class, 'confirm_delete'])->name('admin.elections.candidates.confirm_delete');
    Route::delete('elections/candidates/{candidate}/delete', [Admin_CandidateController::class, 'destroy'])->name('admin.elections.candidates.delete');



    // Result
    Route::get('results/elections', [Admin_ResultController::class, 'index'])->name('admin.results.elections.index');
    Route::get('results/elections/{election}/show', [Admin_ResultController::class, 'show'])->name('admin.results.elections.show');
    Route::get('results/elections/{election}/voters/{voter}/show', [Admin_ResultController::class, 'voter_votes'])->name('admin.results.elections.voter_votes');
    Route::get('results/elections/{election}/candidates/{candidate}/show', [Admin_ResultController::class, 'candidate_votes'])->name('admin.results.elections.candidate_votes');



    // Halls
    Route::get('halls', [Admin_HallController::class, 'index'])->name('admin.halls.index');
    Route::get('halls/create', [Admin_HallController::class, 'create'])->name('admin.halls.create');
    Route::post('halls/store', [Admin_HallController::class, 'store'])->name('admin.halls.store');
    Route::get('halls/{hall}/show', [Admin_HallController::class, 'show'])->name('admin.halls.show');
    Route::get('halls/{hall}/edit', [Admin_HallController::class, 'edit'])->name('admin.halls.edit');
    Route::post('halls/{hall}/update', [Admin_HallController::class, 'update'])->name('admin.halls.update');
    Route::get('halls/{hall}/confirm_delete', [Admin_HallController::class, 'confirm_delete'])->name('admin.halls.confirm_delete');
    Route::delete('halls/{hall}/delete', [Admin_HallController::class, 'destroy'])->name('admin.halls.delete');



    // Hall Residents
    Route::get('halls/{hall}/residents', [Admin_HallResidentController::class, 'index'])->name('admin.halls.residents.index');
    Route::get('halls/{hall}/residents/create', [Admin_HallResidentController::class, 'create'])->name('admin.halls.residents.create');
    Route::post('halls/{hall}/residents/store', [Admin_HallResidentController::class, 'store'])->name('admin.halls.residents.store');
    Route::get('halls/residents/{resident}/edit', [Admin_HallResidentController::class, 'edit'])->name('admin.halls.residents.edit');
    Route::post('halls/residents/{resident}/update', [Admin_HallResidentController::class, 'update'])->name('admin.halls.residents.update');
    Route::get('halls/residents/{resident}/confirm_delete', [Admin_HallResidentController::class, 'confirm_delete'])->name('admin.halls.residents.confirm_delete');
    Route::get('halls/{hall}/residents/delete_hall_residents', [Admin_HallResidentController::class, 'delete_hall_residents'])->name('admin.halls.residents.delete_hall_residents');
    Route::delete('halls/residents/{resident}/delete', [Admin_HallResidentController::class, 'destroy'])->name('admin.halls.residents.delete');
    


    // Upload Residents
    Route::get('residents/halls/{hall}/select_file',  [Admin_ResidentUploadController::class, 'select_file'])->name('admin.halls.residents.uploads.select_file');
    Route::post('residents/halls/{hall}/select_file',  [Admin_ResidentUploadController::class, 'upload'])->name('admin.halls.residents.uploads.upload');
    Route::get('residents/halls/{hall}/save_upload',  [Admin_ResidentUploadController::class, 'save_upload'])->name('admin.halls.residents.uploads.save');
    Route::get('residents/halls/uploads/clear_upload', [Admin_ResidentUploadController::class, 'clear_temp_upload'])->name('admin.halls.residents.uploads.clear_temp_upload');
    Route::delete('residents/halls/uploads/{upload}/delete', [Admin_ResidentUploadController::class, 'destroy'])->name('admin.halls.residents.uploads.delete');

});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


