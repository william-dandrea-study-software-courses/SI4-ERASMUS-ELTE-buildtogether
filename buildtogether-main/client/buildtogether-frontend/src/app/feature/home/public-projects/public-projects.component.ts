import { Component, OnInit } from '@angular/core';
import {Project} from "../../../shared/models/project.model";
import {ProjectService} from "../../../core/service/project.service";

@Component({
  selector: 'app-public-projects',
  templateUrl: './public-projects.component.html',
  styleUrls: ['./public-projects.component.scss']
})
export class PublicProjectsComponent implements OnInit {

  allProjects: Project[] | null = null;

  constructor(private projectService: ProjectService) {
    this.projectService.allProjects$.subscribe(data => {
      this.allProjects = data;
    })
  }

  ngOnInit(): void {
  }

}
