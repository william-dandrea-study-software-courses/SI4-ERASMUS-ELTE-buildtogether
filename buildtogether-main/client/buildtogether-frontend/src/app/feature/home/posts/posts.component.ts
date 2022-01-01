import { Component, OnInit } from '@angular/core';
import {PostService} from "../../../core/service/post.service";
import {Post} from "../../../shared/models/post.model";
import {ThemePalette} from "@angular/material/core";
import {ProgressSpinnerMode} from "@angular/material/progress-spinner";

@Component({
  selector: 'app-posts',
  templateUrl: './posts.component.html',
  styleUrls: ['./posts.component.scss']
})
export class PostsComponent implements OnInit {

  allPosts: Post[] | null = null


  constructor(private postService: PostService) {
    this.postService.allPosts$.subscribe(posts => {
      this.allPosts = posts;
    })
  }

  ngOnInit(): void {
  }

}
