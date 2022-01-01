import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { HomeRoutingModule } from './home-routing.module';
import {SharedModule} from "../../shared/shared.module";
import {HomeComponent} from "./home.component";
import { DashboardComponent } from './dashboard/dashboard.component';
import { PostsComponent } from './posts/posts.component';
import { PublicProjectsComponent } from './public-projects/public-projects.component';
import { UserProfileComponent } from './user-profile/user-profile.component';
import {MatGridListModule} from '@angular/material/grid-list';
import {MatCardModule} from '@angular/material/card';
import {MatIconModule} from '@angular/material/icon';
import {MatDividerModule} from '@angular/material/divider';
import {MatChipsModule} from '@angular/material/chips';
import {MatFormFieldModule} from '@angular/material/form-field';
import {MatButtonModule} from '@angular/material/button';
import { PostThumbnailComponent } from './posts/post-thumbnail/post-thumbnail.component';
import { ProjectThumbnailComponent } from './public-projects/project-thumbnail/project-thumbnail.component';
import {MatInputModule} from '@angular/material/input';

@NgModule({
  declarations: [
    HomeComponent,
    DashboardComponent,
    PostsComponent,
    PublicProjectsComponent,
    UserProfileComponent,
    PostThumbnailComponent,
    ProjectThumbnailComponent
  ],
  imports: [
    CommonModule,
    HomeRoutingModule,
    SharedModule.forRoot(),
    MatGridListModule,
    MatCardModule,
    MatIconModule,
    MatDividerModule,
    MatChipsModule,
    MatFormFieldModule,
    MatButtonModule,
    MatInputModule
  ]
})
export class HomeModule { }
