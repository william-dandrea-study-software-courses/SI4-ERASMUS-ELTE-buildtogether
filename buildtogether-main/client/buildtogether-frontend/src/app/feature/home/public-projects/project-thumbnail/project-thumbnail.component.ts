import {Component, Input, OnInit} from '@angular/core';
import {Project} from "../../../../shared/models/project.model";

@Component({
  selector: 'app-project-thumbnail',
  templateUrl: './project-thumbnail.component.html',
  styleUrls: ['./project-thumbnail.component.scss']
})
export class ProjectThumbnailComponent implements OnInit {

  @Input() project: Project | null

  constructor() {

  }

  ngOnInit(): void {


  }

}
