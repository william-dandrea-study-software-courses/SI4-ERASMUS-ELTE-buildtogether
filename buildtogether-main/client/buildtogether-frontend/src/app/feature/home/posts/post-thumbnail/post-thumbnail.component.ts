import {Component, Input, OnInit} from '@angular/core';
import {Post} from "../../../../shared/models/post.model";

@Component({
  selector: 'app-post-thumbnail',
  templateUrl: './post-thumbnail.component.html',
  styleUrls: ['./post-thumbnail.component.scss']
})
export class PostThumbnailComponent implements OnInit {

  @Input() post: Post | null = null;

  constructor() { }

  ngOnInit(): void {}

}
